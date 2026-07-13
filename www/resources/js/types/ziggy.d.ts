import { Route } from 'ziggy-js'

declare module '@vue/runtime-core' {
  interface ComponentCustomProperties {
    route: (name: string, params?: any, absolute?: boolean) => string
  }
}
