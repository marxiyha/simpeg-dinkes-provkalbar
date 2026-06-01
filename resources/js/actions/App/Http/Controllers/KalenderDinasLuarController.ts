import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\KalenderDinasLuarController::index
* @see app/Http/Controllers/KalenderDinasLuarController.php:11
* @route '/dinasluar/kalender'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/dinasluar/kalender',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::index
* @see app/Http/Controllers/KalenderDinasLuarController.php:11
* @route '/dinasluar/kalender'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::index
* @see app/Http/Controllers/KalenderDinasLuarController.php:11
* @route '/dinasluar/kalender'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::index
* @see app/Http/Controllers/KalenderDinasLuarController.php:11
* @route '/dinasluar/kalender'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::index
* @see app/Http/Controllers/KalenderDinasLuarController.php:11
* @route '/dinasluar/kalender'
*/
const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::index
* @see app/Http/Controllers/KalenderDinasLuarController.php:11
* @route '/dinasluar/kalender'
*/
indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::index
* @see app/Http/Controllers/KalenderDinasLuarController.php:11
* @route '/dinasluar/kalender'
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
* @see \App\Http\Controllers\KalenderDinasLuarController::rekapGlobal
* @see app/Http/Controllers/KalenderDinasLuarController.php:27
* @route '/dinasluar/rekap'
*/
const rekapGlobal0a8d28d4ee0c9cc09e1d5c942603566c = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: rekapGlobal0a8d28d4ee0c9cc09e1d5c942603566c.url(options),
    method: 'get',
})

rekapGlobal0a8d28d4ee0c9cc09e1d5c942603566c.definition = {
    methods: ["get","head"],
    url: '/dinasluar/rekap',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::rekapGlobal
* @see app/Http/Controllers/KalenderDinasLuarController.php:27
* @route '/dinasluar/rekap'
*/
rekapGlobal0a8d28d4ee0c9cc09e1d5c942603566c.url = (options?: RouteQueryOptions) => {
    return rekapGlobal0a8d28d4ee0c9cc09e1d5c942603566c.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::rekapGlobal
* @see app/Http/Controllers/KalenderDinasLuarController.php:27
* @route '/dinasluar/rekap'
*/
rekapGlobal0a8d28d4ee0c9cc09e1d5c942603566c.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: rekapGlobal0a8d28d4ee0c9cc09e1d5c942603566c.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::rekapGlobal
* @see app/Http/Controllers/KalenderDinasLuarController.php:27
* @route '/dinasluar/rekap'
*/
rekapGlobal0a8d28d4ee0c9cc09e1d5c942603566c.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: rekapGlobal0a8d28d4ee0c9cc09e1d5c942603566c.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::rekapGlobal
* @see app/Http/Controllers/KalenderDinasLuarController.php:27
* @route '/dinasluar/rekap'
*/
const rekapGlobal0a8d28d4ee0c9cc09e1d5c942603566cForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: rekapGlobal0a8d28d4ee0c9cc09e1d5c942603566c.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::rekapGlobal
* @see app/Http/Controllers/KalenderDinasLuarController.php:27
* @route '/dinasluar/rekap'
*/
rekapGlobal0a8d28d4ee0c9cc09e1d5c942603566cForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: rekapGlobal0a8d28d4ee0c9cc09e1d5c942603566c.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::rekapGlobal
* @see app/Http/Controllers/KalenderDinasLuarController.php:27
* @route '/dinasluar/rekap'
*/
rekapGlobal0a8d28d4ee0c9cc09e1d5c942603566cForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: rekapGlobal0a8d28d4ee0c9cc09e1d5c942603566c.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

rekapGlobal0a8d28d4ee0c9cc09e1d5c942603566c.form = rekapGlobal0a8d28d4ee0c9cc09e1d5c942603566cForm
/**
* @see \App\Http\Controllers\KalenderDinasLuarController::rekapGlobal
* @see app/Http/Controllers/KalenderDinasLuarController.php:27
* @route '/petinggi/rekap-dinas-luar'
*/
const rekapGlobal44a590ea8f94ce947bc972b27262b2c7 = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: rekapGlobal44a590ea8f94ce947bc972b27262b2c7.url(options),
    method: 'get',
})

rekapGlobal44a590ea8f94ce947bc972b27262b2c7.definition = {
    methods: ["get","head"],
    url: '/petinggi/rekap-dinas-luar',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::rekapGlobal
* @see app/Http/Controllers/KalenderDinasLuarController.php:27
* @route '/petinggi/rekap-dinas-luar'
*/
rekapGlobal44a590ea8f94ce947bc972b27262b2c7.url = (options?: RouteQueryOptions) => {
    return rekapGlobal44a590ea8f94ce947bc972b27262b2c7.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::rekapGlobal
* @see app/Http/Controllers/KalenderDinasLuarController.php:27
* @route '/petinggi/rekap-dinas-luar'
*/
rekapGlobal44a590ea8f94ce947bc972b27262b2c7.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: rekapGlobal44a590ea8f94ce947bc972b27262b2c7.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::rekapGlobal
* @see app/Http/Controllers/KalenderDinasLuarController.php:27
* @route '/petinggi/rekap-dinas-luar'
*/
rekapGlobal44a590ea8f94ce947bc972b27262b2c7.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: rekapGlobal44a590ea8f94ce947bc972b27262b2c7.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::rekapGlobal
* @see app/Http/Controllers/KalenderDinasLuarController.php:27
* @route '/petinggi/rekap-dinas-luar'
*/
const rekapGlobal44a590ea8f94ce947bc972b27262b2c7Form = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: rekapGlobal44a590ea8f94ce947bc972b27262b2c7.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::rekapGlobal
* @see app/Http/Controllers/KalenderDinasLuarController.php:27
* @route '/petinggi/rekap-dinas-luar'
*/
rekapGlobal44a590ea8f94ce947bc972b27262b2c7Form.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: rekapGlobal44a590ea8f94ce947bc972b27262b2c7.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::rekapGlobal
* @see app/Http/Controllers/KalenderDinasLuarController.php:27
* @route '/petinggi/rekap-dinas-luar'
*/
rekapGlobal44a590ea8f94ce947bc972b27262b2c7Form.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: rekapGlobal44a590ea8f94ce947bc972b27262b2c7.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

rekapGlobal44a590ea8f94ce947bc972b27262b2c7.form = rekapGlobal44a590ea8f94ce947bc972b27262b2c7Form

export const rekapGlobal = {
    '/dinasluar/rekap': rekapGlobal0a8d28d4ee0c9cc09e1d5c942603566c,
    '/petinggi/rekap-dinas-luar': rekapGlobal44a590ea8f94ce947bc972b27262b2c7,
}

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::indexGlobal
* @see app/Http/Controllers/KalenderDinasLuarController.php:19
* @route '/petinggi/kalender-dinas-luar'
*/
export const indexGlobal = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: indexGlobal.url(options),
    method: 'get',
})

indexGlobal.definition = {
    methods: ["get","head"],
    url: '/petinggi/kalender-dinas-luar',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::indexGlobal
* @see app/Http/Controllers/KalenderDinasLuarController.php:19
* @route '/petinggi/kalender-dinas-luar'
*/
indexGlobal.url = (options?: RouteQueryOptions) => {
    return indexGlobal.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::indexGlobal
* @see app/Http/Controllers/KalenderDinasLuarController.php:19
* @route '/petinggi/kalender-dinas-luar'
*/
indexGlobal.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: indexGlobal.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::indexGlobal
* @see app/Http/Controllers/KalenderDinasLuarController.php:19
* @route '/petinggi/kalender-dinas-luar'
*/
indexGlobal.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: indexGlobal.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::indexGlobal
* @see app/Http/Controllers/KalenderDinasLuarController.php:19
* @route '/petinggi/kalender-dinas-luar'
*/
const indexGlobalForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: indexGlobal.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::indexGlobal
* @see app/Http/Controllers/KalenderDinasLuarController.php:19
* @route '/petinggi/kalender-dinas-luar'
*/
indexGlobalForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: indexGlobal.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::indexGlobal
* @see app/Http/Controllers/KalenderDinasLuarController.php:19
* @route '/petinggi/kalender-dinas-luar'
*/
indexGlobalForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: indexGlobal.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

indexGlobal.form = indexGlobalForm

const KalenderDinasLuarController = { index, rekapGlobal, indexGlobal }

export default KalenderDinasLuarController