# Question 1

Is there a way to set a foreign key to several foreign tables? For example: my column can store the value of 1, relate to an id of table string_metadata, but also store another 1, but related to an id of a int_metadata table. Is it possible?

# Answer 1

Short answer: **no — relational databases (including MySQL) do not support a single foreign key that references multiple tables.**

A foreign key must point to **one specific table**. What you're describing is often called a **“polymorphic association”**, and SQL engines don’t enforce that natively.

---

## Why it’s not supported

Foreign keys rely on strict guarantees:

* The referenced table is known
* The referenced row must exist

If a column could reference *different tables*, the database wouldn’t know:

* where to check integrity
* how to enforce constraints

---

## Common ways to model this

### ✅ 1. **Polymorphic association (application-enforced)**

You store both:

* `metadata_id`
* `metadata_type` (e.g. `'string'`, `'int'`)

```sql
metadata_id INT,
metadata_type VARCHAR(50)
```

Example data:

```
metadata_id | metadata_type
------------|---------------
1           | string
1           | int
```

👉 Used in frameworks like Laravel (`morphTo`).

**Pros:**

* Flexible
* Simple schema

**Cons:**

* ❌ No DB-level integrity enforcement
* You must validate in your application

---

### ✅ 2. **Separate nullable foreign keys (strict but less elegant)**

```sql
string_metadata_id INT NULL,
int_metadata_id INT NULL,
FOREIGN KEY (string_metadata_id) REFERENCES string_metadata(id),
FOREIGN KEY (int_metadata_id) REFERENCES int_metadata(id)
```

👉 Enforce that only one is filled (via app logic or CHECK constraint if supported)

**Pros:**

* ✅ Real foreign keys
* DB enforces integrity

**Cons:**

* Awkward schema
* Doesn’t scale well with many types

---

### ✅ 3. **Single “parent” table (best normalized approach)**

Create a shared table:

```sql
metadata (
  id INT PRIMARY KEY,
  type ENUM('string', 'int')
)
```

Then:

```sql
string_metadata (
  id INT PRIMARY KEY,
  FOREIGN KEY (id) REFERENCES metadata(id)
)

int_metadata (
  id INT PRIMARY KEY,
  FOREIGN KEY (id) REFERENCES metadata(id)
)
```

Your referencing table:

```sql
metadata_id INT,
FOREIGN KEY (metadata_id) REFERENCES metadata(id)
```

**Pros:**

* ✅ Proper normalization
* ✅ Full referential integrity
* Scales well

**Cons:**

* Slightly more complex design

---

### 🚫 What you cannot do

This is **not valid SQL**:

```sql
FOREIGN KEY (metadata_id)
REFERENCES string_metadata(id) OR int_metadata(id)
```

---

## Recommendation

* If you want **clean + scalable + safe design** → use **option 3 (parent table)**
* If you want **flexibility and are using Laravel** → use **polymorphic (option 1)**

---

If you want, I can show you how to implement this specifically in **Laravel migrations + Eloquent models**, since this pattern is very common there.

## Question 2

I have this table schemas. For the parent metadata (metadata):
```
+----------------+-----------------+------+-----+---------+----------------+
| Field          | Type            | Null | Key | Default | Extra          |
+----------------+-----------------+------+-----+---------+----------------+
| id             | bigint unsigned | NO   | PRI | NULL    | auto_increment |
| meta_name      | varchar(255)    | NO   |     | NULL    |                |
| valueable_type | varchar(255)    | NO   | MUL | NULL    |                |
| valueable_id   | bigint unsigned | NO   | MUL | NULL    |                |
| created_at     | timestamp       | YES  |     | NULL    |                |
| updated_at     | timestamp       | YES  |     | NULL    |                |
| content_id     | bigint unsigned | NO   | MUL | NULL    |                |
+----------------+-----------------+------+-----+---------+----------------+
```

The childs metadata schema, string_metadata and int_metadata:
```
+-------+-----------------+------+-----+---------+----------------+
| Field | Type            | Null | Key | Default | Extra          |
+-------+-----------------+------+-----+---------+----------------+
| id    | bigint unsigned | NO   | PRI | NULL    | auto_increment |
| value | varchar(255)    | NO   |     | NULL    |                |
+-------+-----------------+------+-----+---------+----------------+

+-------+-----------------+------+-----+---------+----------------+
| Field | Type            | Null | Key | Default | Extra          |
+-------+-----------------+------+-----+---------+----------------+
| id    | bigint unsigned | NO   | PRI | NULL    | auto_increment |
| value | int             | NO   |     | NULL    |                |
+-------+-----------------+------+-----+---------+----------------+
```

As you can realize, this is a set for a polymorphic relationship handled by Laravel. The problem is that the valueable_id can relate to different tables, so I can enforce it by foreign keys.

As you showed me formerly, I can put the relation value in the child tables, so it will make the database helps to keep the data consistent. My doubt is if Laravel allows it. Is there some way to do so, then the valueable_id will move to the child tables, or something like that.

## Answer 2

You’re absolutely right about the core issue: **Laravel polymorphic relations (`valueable_type` + `valueable_id`) cannot be enforced with foreign keys**, because they intentionally point to multiple tables.

And your intuition is also correct: *moving the relationship to the child tables* would let the database enforce integrity — but that changes how Laravel typically models polymorphism.

Let’s break this down clearly.

---

# 🚨 The core conflict

Laravel’s polymorphic system (`morphTo`) is:

* ✅ Flexible
* ❌ Not enforceable at DB level

Whereas foreign keys are:

* ✅ Strict and safe
* ❌ Require a single target table

So you must choose between:
👉 **Flexibility (Laravel default)**
👉 **Integrity (database-enforced design)**

---

# ✅ Can Laravel support the “parent table” approach?

Yes — and this is actually the **best solution** if you want both:

* clean architecture
* database integrity
* Laravel compatibility

But you need to **stop using polymorphic (`morphTo`)** and switch to **normal relationships + inheritance pattern**.

---

# ✅ Recommended redesign (your case)

## 1. Make `metadata` the “owner”

```sql
metadata
- id
- meta_name
- content_id
- type (string | int)
```

🚨 Remove:

```sql
valueable_type
valueable_id
```

---

## 2. Move FK to child tables

### string_metadata

```sql
id
metadata_id (FK → metadata.id)
value
```

### int_metadata

```sql
id
metadata_id (FK → metadata.id)
value
```

Now the database enforces everything:

* A child **must belong to a metadata**
* A metadata can have **only one value (enforce via unique)**

---

## 3. Laravel models

### Metadata.php

```php
class Metadata extends Model
{
    public function stringValue()
    {
        return $this->hasOne(StringMetadata::class);
    }

    public function intValue()
    {
        return $this->hasOne(IntMetadata::class);
    }

    public function value()
    {
        return match ($this->type) {
            'string' => $this->stringValue,
            'int' => $this->intValue,
        };
    }
}
```

---

### StringMetadata.php

```php
class StringMetadata extends Model
{
    public function metadata()
    {
        return $this->belongsTo(Metadata::class);
    }
}
```

---

### IntMetadata.php

```php
class IntMetadata extends Model
{
    public function metadata()
    {
        return $this->belongsTo(Metadata::class);
    }
}
```

---

# 🤔 What you lose vs polymorphic

| Feature                     | Polymorphic | This approach |
| --------------------------- | ----------- | ------------- |
| Auto resolution (`morphTo`) | ✅           | ❌             |
| DB integrity                | ❌           | ✅             |
| Performance                 | ⚠️          | ✅             |
| Explicitness                | ❌           | ✅             |

---

# 💡 Important improvement

Add a **UNIQUE constraint**:

```sql
UNIQUE(metadata_id)
```

on each child table → ensures **1 metadata = 1 value**

---

# 🔥 Alternative (if you want to keep polymorphic)

If you **must** keep Laravel polymorphism:

👉 You cannot enforce FK
👉 But you can mitigate:

* Use **application validation**
* Use **database triggers** (advanced, not Laravel-friendly)
* Use **UUIDs + centralized registry table**

---

# 🧠 Recommendation for your case

Given your schema:

👉 You are modeling **typed metadata values**

This is a classic case where polymorphism is **overused**.

✔ Better approach:

* Drop polymorphic
* Use **parent + typed child tables**
* Let DB enforce integrity

---

# 🚀 Final answer

> **Yes, Laravel allows this design — but not with `morphTo`.**

You’ll switch from:

```php
morphTo()
```

to:

```php
hasOne() + belongsTo()
```

And gain:

* real foreign keys
* safer data
* cleaner domain model

---

If you want, I can rewrite your **Laravel migrations** and show exactly how to enforce:

* one value per metadata
* correct typing
* and even add a clean accessor like `$metadata->value` that feels just like polymorphism 👍

## Question 3

I understood and seems like it have more advantages to drop the polymorphic relationship. But there's something that make me real bothered: the problem is that the parent model (Metadata) must have a relationship method both for StringMetadata and IntMetadata. It can confuse the developer, because he may wonders that the MetaData can relate to both StringMetadata and IntMetadata at once, and I don't want this by design. Is there a way to follows your recommendation to drop morphTo relationship, but keep just one relationship method, that can relate to StringMetadata or IntMetadata at once?

## Answer 3

Yeah — that discomfort you’re feeling is **100% valid**, and it’s actually a sign you’re thinking about *good domain design*, not just “making Laravel work”.

You want:

* ✅ DB integrity (no polymorphic FK issues)
* ✅ Clean API (only **one** relationship)
* ❌ Avoid misleading methods like `stringValue()` and `intValue()`

Let’s be very direct:

> ❗ **Laravel does NOT have a built-in relationship that behaves like `morphTo` but with FK enforcement.**

So we need to *simulate* that clean API.

---

# ✅ Best practical solution: **Single “virtual” relationship**

You keep the **strict DB design**, but expose **only one logical accessor** in your model.

---

## 🧱 Database (same as before — correct design)

* `metadata`
* `string_metadata (metadata_id FK)`
* `int_metadata (metadata_id FK)`

---

## 🧠 Model design trick

Instead of exposing both relations, you:

* Keep them **private/internal**
* Expose only **one public method: `value()`**

---

## ✨ Clean implementation

### Metadata.php

```php
class Metadata extends Model
{
    // Internal relations (hidden from devs)
    protected function stringValueRelation()
    {
        return $this->hasOne(StringMetadata::class);
    }

    protected function intValueRelation()
    {
        return $this->hasOne(IntMetadata::class);
    }

    // ✅ The ONLY public API
    public function value()
    {
        return match ($this->type) {
            'string' => $this->stringValueRelation()->first(),
            'int' => $this->intValueRelation()->first(),
            default => null,
        };
    }
}
```

---

## ✅ Usage (clean and safe)

```php
$metadata->value()->value;
```

👉 Developer sees:

* only **one entry point**
* no confusion
* matches your domain rule: “metadata has ONE value”

---

# 🔥 Even better: make it feel like a property

You can make it even cleaner:

```php
public function getValueAttribute()
{
    return match ($this->type) {
        'string' => optional($this->stringValueRelation()->first())->value,
        'int' => optional($this->intValueRelation()->first())->value,
    };
}
```

---

## ✅ Now usage becomes:

```php
$metadata->value
```

💥 This feels exactly like polymorphic — but is:

* type-safe
* FK-safe
* domain-correct

---

# 🚀 Bonus: enforce correctness at DB level

To guarantee **only one child exists**, add:

### In `string_metadata`

```sql
UNIQUE(metadata_id)
```

### In `int_metadata`

```sql
UNIQUE(metadata_id)
```

And optionally enforce consistency:

* via application logic
* or DB CHECK constraint (if supported)

---

# 🧠 Architectural insight (important)

What you're really building is:

> A **“typed value object” pattern**, not true polymorphism.

That’s why:

* polymorphic relations feel convenient
* but structurally incorrect for your case

---

# ❗ Alternative (if you want TRUE single relation)

There *is* one more option:

## 👉 Single table for values

```sql
metadata_values
- id
- metadata_id (FK)
- type (string, int)
- string_value NULL
- int_value NULL
```

Then:

```php
public function value()
{
    return $this->hasOne(MetadataValue::class);
}
```

✔ One relationship
✔ FK enforced
❌ Less normalized
❌ More nullable columns

---

# 🏁 Final recommendation

Given your concern:

👉 **Keep separate tables + FK (your current redesign)**
👉 Hide internal relations
👉 Expose only:

```php
$metadata->value
```

That gives you:

* ✅ Clean developer experience
* ✅ No ambiguity
* ✅ Strong database integrity
* ✅ Laravel-friendly

---

If you want, I can go one step further and show how to:

* eager load this properly (without N+1)
* or build a **custom Eloquent relation class** that behaves almost like `morphTo` but backed by your schema (more advanced, but very powerful)

