<template>
  <AppLayout>
    <div
      class="max-w-3xl lg:max-w-5xl xl:max-w-7xl mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden p-8">
      <h1 class="text-2xl font-bold mb-4">
        Contents Index Page
      </h1>


      <ul class="divide-y divide-gray-200 dark:divide-gray-700">

        <ShowingSingleMeta :tag="'Published'" :metaDatas="[{ metaName: 'name', metaValue: 'Danilo' }, { metaName: 'age', metaValue: 25 }, { metaName: 'type', metaValue: 'human' }, { metaName: 'size', metaValue: '120 kb' }]
          " />
        <ShowingSingleMeta :tag="'Published'" :metaDatas="[{ metaName: 'name', metaValue: 'Danilo' }, { metaName: 'age', metaValue: 25 }, { metaName: 'type', metaValue: 'human' }, { metaName: 'size', metaValue: '120 kb' }]
        " />
        <ShowingSingleMeta :metaDatas="[{ metaName: 'name', metaValue: 'Danilo' }, { metaName: 'age', metaValue: 25 }, { metaName: 'type', metaValue: 'human' }, { metaName: 'size', metaValue: '120 kb' }]
        "/>

      </ul>
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from '../../Layouts/AppLayout.vue'
import ShowingSingleMeta from '../../components/ShowingSingleMeta.vue'

export default {
  name: 'ContentsIndex',
  components: {
    AppLayout,
    ShowingSingleMeta,
  },
  props: {
    // Define any props you want to receive from your controller
  },
  mounted() {
    console.log('Contents index page loaded')
  },
}
</script>
