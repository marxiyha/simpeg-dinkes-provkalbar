import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../wayfinder'
/**
* @see \App\Http\Controllers\KalenderDinasLuarController::kalender
* @see app/Http/Controllers/KalenderDinasLuarController.php:11
* @route '/dinasluar/kalender'
*/
export const kalender = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: kalender.url(options),
    method: 'get',
})

kalender.definition = {
    methods: ["get","head"],
    url: '/dinasluar/kalender',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::kalender
* @see app/Http/Controllers/KalenderDinasLuarController.php:11
* @route '/dinasluar/kalender'
*/
kalender.url = (options?: RouteQueryOptions) => {
    return kalender.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::kalender
* @see app/Http/Controllers/KalenderDinasLuarController.php:11
* @route '/dinasluar/kalender'
*/
kalender.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: kalender.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::kalender
* @see app/Http/Controllers/KalenderDinasLuarController.php:11
* @route '/dinasluar/kalender'
*/
kalender.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: kalender.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::kalender
* @see app/Http/Controllers/KalenderDinasLuarController.php:11
* @route '/dinasluar/kalender'
*/
const kalenderForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: kalender.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::kalender
* @see app/Http/Controllers/KalenderDinasLuarController.php:11
* @route '/dinasluar/kalender'
*/
kalenderForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: kalender.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::kalender
* @see app/Http/Controllers/KalenderDinasLuarController.php:11
* @route '/dinasluar/kalender'
*/
kalenderForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: kalender.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

kalender.form = kalenderForm

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::rekap
* @see app/Http/Controllers/KalenderDinasLuarController.php:27
* @route '/dinasluar/rekap'
*/
export const rekap = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: rekap.url(options),
    method: 'get',
})

rekap.definition = {
    methods: ["get","head"],
    url: '/dinasluar/rekap',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::rekap
* @see app/Http/Controllers/KalenderDinasLuarController.php:27
* @route '/dinasluar/rekap'
*/
rekap.url = (options?: RouteQueryOptions) => {
    return rekap.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::rekap
* @see app/Http/Controllers/KalenderDinasLuarController.php:27
* @route '/dinasluar/rekap'
*/
rekap.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: rekap.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::rekap
* @see app/Http/Controllers/KalenderDinasLuarController.php:27
* @route '/dinasluar/rekap'
*/
rekap.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: rekap.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::rekap
* @see app/Http/Controllers/KalenderDinasLuarController.php:27
* @route '/dinasluar/rekap'
*/
const rekapForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: rekap.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::rekap
* @see app/Http/Controllers/KalenderDinasLuarController.php:27
* @route '/dinasluar/rekap'
*/
rekapForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: rekap.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::rekap
* @see app/Http/Controllers/KalenderDinasLuarController.php:27
* @route '/dinasluar/rekap'
*/
rekapForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: rekap.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

rekap.form = rekapForm

const dinasluar = {
    kalender: Object.assign(kalender, kalender),
    rekap: Object.assign(rekap, rekap),
}

export default dinasluar