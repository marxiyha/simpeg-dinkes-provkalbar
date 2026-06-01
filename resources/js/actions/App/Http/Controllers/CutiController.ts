import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\CutiController::approval
* @see app/Http/Controllers/CutiController.php:36
* @route '/cuti/approval'
*/
export const approval = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: approval.url(options),
    method: 'get',
})

approval.definition = {
    methods: ["get","head"],
    url: '/cuti/approval',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\CutiController::approval
* @see app/Http/Controllers/CutiController.php:36
* @route '/cuti/approval'
*/
approval.url = (options?: RouteQueryOptions) => {
    return approval.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\CutiController::approval
* @see app/Http/Controllers/CutiController.php:36
* @route '/cuti/approval'
*/
approval.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: approval.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\CutiController::approval
* @see app/Http/Controllers/CutiController.php:36
* @route '/cuti/approval'
*/
approval.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: approval.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\CutiController::approval
* @see app/Http/Controllers/CutiController.php:36
* @route '/cuti/approval'
*/
const approvalForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: approval.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\CutiController::approval
* @see app/Http/Controllers/CutiController.php:36
* @route '/cuti/approval'
*/
approvalForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: approval.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\CutiController::approval
* @see app/Http/Controllers/CutiController.php:36
* @route '/cuti/approval'
*/
approvalForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: approval.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

approval.form = approvalForm

/**
* @see \App\Http\Controllers\CutiController::rekap
* @see app/Http/Controllers/CutiController.php:13
* @route '/cuti/rekap'
*/
export const rekap = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: rekap.url(options),
    method: 'get',
})

rekap.definition = {
    methods: ["get","head"],
    url: '/cuti/rekap',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\CutiController::rekap
* @see app/Http/Controllers/CutiController.php:13
* @route '/cuti/rekap'
*/
rekap.url = (options?: RouteQueryOptions) => {
    return rekap.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\CutiController::rekap
* @see app/Http/Controllers/CutiController.php:13
* @route '/cuti/rekap'
*/
rekap.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: rekap.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\CutiController::rekap
* @see app/Http/Controllers/CutiController.php:13
* @route '/cuti/rekap'
*/
rekap.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: rekap.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\CutiController::rekap
* @see app/Http/Controllers/CutiController.php:13
* @route '/cuti/rekap'
*/
const rekapForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: rekap.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\CutiController::rekap
* @see app/Http/Controllers/CutiController.php:13
* @route '/cuti/rekap'
*/
rekapForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: rekap.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\CutiController::rekap
* @see app/Http/Controllers/CutiController.php:13
* @route '/cuti/rekap'
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

/**
* @see \App\Http\Controllers\CutiController::updateStatusHtml
* @see app/Http/Controllers/CutiController.php:87
* @route '/cuti/update/{id}'
*/
export const updateStatusHtml = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: updateStatusHtml.url(args, options),
    method: 'post',
})

updateStatusHtml.definition = {
    methods: ["post"],
    url: '/cuti/update/{id}',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\CutiController::updateStatusHtml
* @see app/Http/Controllers/CutiController.php:87
* @route '/cuti/update/{id}'
*/
updateStatusHtml.url = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { id: args }
    }

    if (Array.isArray(args)) {
        args = {
            id: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        id: args.id,
    }

    return updateStatusHtml.definition.url
            .replace('{id}', parsedArgs.id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\CutiController::updateStatusHtml
* @see app/Http/Controllers/CutiController.php:87
* @route '/cuti/update/{id}'
*/
updateStatusHtml.post = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: updateStatusHtml.url(args, options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\CutiController::updateStatusHtml
* @see app/Http/Controllers/CutiController.php:87
* @route '/cuti/update/{id}'
*/
const updateStatusHtmlForm = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: updateStatusHtml.url(args, options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\CutiController::updateStatusHtml
* @see app/Http/Controllers/CutiController.php:87
* @route '/cuti/update/{id}'
*/
updateStatusHtmlForm.post = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: updateStatusHtml.url(args, options),
    method: 'post',
})

updateStatusHtml.form = updateStatusHtmlForm

/**
* @see \App\Http\Controllers\CutiController::deleteCuti
* @see app/Http/Controllers/CutiController.php:114
* @route '/cuti/delete/{id}'
*/
export const deleteCuti = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: deleteCuti.url(args, options),
    method: 'delete',
})

deleteCuti.definition = {
    methods: ["delete"],
    url: '/cuti/delete/{id}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\CutiController::deleteCuti
* @see app/Http/Controllers/CutiController.php:114
* @route '/cuti/delete/{id}'
*/
deleteCuti.url = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { id: args }
    }

    if (Array.isArray(args)) {
        args = {
            id: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        id: args.id,
    }

    return deleteCuti.definition.url
            .replace('{id}', parsedArgs.id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\CutiController::deleteCuti
* @see app/Http/Controllers/CutiController.php:114
* @route '/cuti/delete/{id}'
*/
deleteCuti.delete = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: deleteCuti.url(args, options),
    method: 'delete',
})

/**
* @see \App\Http\Controllers\CutiController::deleteCuti
* @see app/Http/Controllers/CutiController.php:114
* @route '/cuti/delete/{id}'
*/
const deleteCutiForm = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: deleteCuti.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'DELETE',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

/**
* @see \App\Http\Controllers\CutiController::deleteCuti
* @see app/Http/Controllers/CutiController.php:114
* @route '/cuti/delete/{id}'
*/
deleteCutiForm.delete = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: deleteCuti.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'DELETE',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

deleteCuti.form = deleteCutiForm

const CutiController = { approval, rekap, updateStatusHtml, deleteCuti }

export default CutiController