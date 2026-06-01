import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../wayfinder'
/**
* @see \App\Http\Controllers\KalenderDinasLuarController::kalender
* @see app/Http/Controllers/KalenderDinasLuarController.php:19
* @route '/petinggi/kalender-dinas-luar'
*/
export const kalender = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: kalender.url(options),
    method: 'get',
})

kalender.definition = {
    methods: ["get","head"],
    url: '/petinggi/kalender-dinas-luar',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::kalender
* @see app/Http/Controllers/KalenderDinasLuarController.php:19
* @route '/petinggi/kalender-dinas-luar'
*/
kalender.url = (options?: RouteQueryOptions) => {
    return kalender.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::kalender
* @see app/Http/Controllers/KalenderDinasLuarController.php:19
* @route '/petinggi/kalender-dinas-luar'
*/
kalender.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: kalender.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::kalender
* @see app/Http/Controllers/KalenderDinasLuarController.php:19
* @route '/petinggi/kalender-dinas-luar'
*/
kalender.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: kalender.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::kalender
* @see app/Http/Controllers/KalenderDinasLuarController.php:19
* @route '/petinggi/kalender-dinas-luar'
*/
const kalenderForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: kalender.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::kalender
* @see app/Http/Controllers/KalenderDinasLuarController.php:19
* @route '/petinggi/kalender-dinas-luar'
*/
kalenderForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: kalender.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::kalender
* @see app/Http/Controllers/KalenderDinasLuarController.php:19
* @route '/petinggi/kalender-dinas-luar'
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
* @route '/petinggi/rekap-dinas-luar'
*/
export const rekap = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: rekap.url(options),
    method: 'get',
})

rekap.definition = {
    methods: ["get","head"],
    url: '/petinggi/rekap-dinas-luar',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::rekap
* @see app/Http/Controllers/KalenderDinasLuarController.php:27
* @route '/petinggi/rekap-dinas-luar'
*/
rekap.url = (options?: RouteQueryOptions) => {
    return rekap.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::rekap
* @see app/Http/Controllers/KalenderDinasLuarController.php:27
* @route '/petinggi/rekap-dinas-luar'
*/
rekap.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: rekap.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::rekap
* @see app/Http/Controllers/KalenderDinasLuarController.php:27
* @route '/petinggi/rekap-dinas-luar'
*/
rekap.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: rekap.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::rekap
* @see app/Http/Controllers/KalenderDinasLuarController.php:27
* @route '/petinggi/rekap-dinas-luar'
*/
const rekapForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: rekap.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::rekap
* @see app/Http/Controllers/KalenderDinasLuarController.php:27
* @route '/petinggi/rekap-dinas-luar'
*/
rekapForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: rekap.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\KalenderDinasLuarController::rekap
* @see app/Http/Controllers/KalenderDinasLuarController.php:27
* @route '/petinggi/rekap-dinas-luar'
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

const petinggi = {
    kalender: Object.assign(kalender, kalender),
    rekap: Object.assign(rekap, rekap),
}

export default petinggi