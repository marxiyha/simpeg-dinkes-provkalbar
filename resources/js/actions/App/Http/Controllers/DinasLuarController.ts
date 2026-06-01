import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\DinasLuarController::index
* @see app/Http/Controllers/DinasLuarController.php:11
* @route '/dinas-luar'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/dinas-luar',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\DinasLuarController::index
* @see app/Http/Controllers/DinasLuarController.php:11
* @route '/dinas-luar'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\DinasLuarController::index
* @see app/Http/Controllers/DinasLuarController.php:11
* @route '/dinas-luar'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\DinasLuarController::index
* @see app/Http/Controllers/DinasLuarController.php:11
* @route '/dinas-luar'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\DinasLuarController::index
* @see app/Http/Controllers/DinasLuarController.php:11
* @route '/dinas-luar'
*/
const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\DinasLuarController::index
* @see app/Http/Controllers/DinasLuarController.php:11
* @route '/dinas-luar'
*/
indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\DinasLuarController::index
* @see app/Http/Controllers/DinasLuarController.php:11
* @route '/dinas-luar'
*/
indexForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

index.form = indexForm

/**
* @see \App\Http\Controllers\DinasLuarController::store
* @see app/Http/Controllers/DinasLuarController.php:22
* @route '/dinas-luar'
*/
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/dinas-luar',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\DinasLuarController::store
* @see app/Http/Controllers/DinasLuarController.php:22
* @route '/dinas-luar'
*/
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\DinasLuarController::store
* @see app/Http/Controllers/DinasLuarController.php:22
* @route '/dinas-luar'
*/
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\DinasLuarController::store
* @see app/Http/Controllers/DinasLuarController.php:22
* @route '/dinas-luar'
*/
const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\DinasLuarController::store
* @see app/Http/Controllers/DinasLuarController.php:22
* @route '/dinas-luar'
*/
storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(options),
    method: 'post',
})

store.form = storeForm

const DinasLuarController = { index, store }

export default DinasLuarController