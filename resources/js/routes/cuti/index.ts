import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../wayfinder'
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
* @see \App\Http\Controllers\PengajuanCutiController::store
* @see app/Http/Controllers/PengajuanCutiController.php:18
* @route '/cuti/store'
*/
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/cuti/store',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\PengajuanCutiController::store
* @see app/Http/Controllers/PengajuanCutiController.php:18
* @route '/cuti/store'
*/
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\PengajuanCutiController::store
* @see app/Http/Controllers/PengajuanCutiController.php:18
* @route '/cuti/store'
*/
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\PengajuanCutiController::store
* @see app/Http/Controllers/PengajuanCutiController.php:18
* @route '/cuti/store'
*/
const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\PengajuanCutiController::store
* @see app/Http/Controllers/PengajuanCutiController.php:18
* @route '/cuti/store'
*/
storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(options),
    method: 'post',
})

store.form = storeForm

/**
* @see \App\Http\Controllers\CutiController::update
* @see app/Http/Controllers/CutiController.php:87
* @route '/cuti/update/{id}'
*/
export const update = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: update.url(args, options),
    method: 'post',
})

update.definition = {
    methods: ["post"],
    url: '/cuti/update/{id}',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\CutiController::update
* @see app/Http/Controllers/CutiController.php:87
* @route '/cuti/update/{id}'
*/
update.url = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions) => {
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

    return update.definition.url
            .replace('{id}', parsedArgs.id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\CutiController::update
* @see app/Http/Controllers/CutiController.php:87
* @route '/cuti/update/{id}'
*/
update.post = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: update.url(args, options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\CutiController::update
* @see app/Http/Controllers/CutiController.php:87
* @route '/cuti/update/{id}'
*/
const updateForm = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: update.url(args, options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\CutiController::update
* @see app/Http/Controllers/CutiController.php:87
* @route '/cuti/update/{id}'
*/
updateForm.post = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: update.url(args, options),
    method: 'post',
})

update.form = updateForm

/**
* @see \App\Http\Controllers\CutiController::deleteMethod
* @see app/Http/Controllers/CutiController.php:114
* @route '/cuti/delete/{id}'
*/
export const deleteMethod = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: deleteMethod.url(args, options),
    method: 'delete',
})

deleteMethod.definition = {
    methods: ["delete"],
    url: '/cuti/delete/{id}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\CutiController::deleteMethod
* @see app/Http/Controllers/CutiController.php:114
* @route '/cuti/delete/{id}'
*/
deleteMethod.url = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions) => {
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

    return deleteMethod.definition.url
            .replace('{id}', parsedArgs.id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\CutiController::deleteMethod
* @see app/Http/Controllers/CutiController.php:114
* @route '/cuti/delete/{id}'
*/
deleteMethod.delete = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: deleteMethod.url(args, options),
    method: 'delete',
})

/**
* @see \App\Http\Controllers\CutiController::deleteMethod
* @see app/Http/Controllers/CutiController.php:114
* @route '/cuti/delete/{id}'
*/
const deleteMethodForm = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: deleteMethod.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'DELETE',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

/**
* @see \App\Http\Controllers\CutiController::deleteMethod
* @see app/Http/Controllers/CutiController.php:114
* @route '/cuti/delete/{id}'
*/
deleteMethodForm.delete = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: deleteMethod.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'DELETE',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

deleteMethod.form = deleteMethodForm

const cuti = {
    approval: Object.assign(approval, approval),
    rekap: Object.assign(rekap, rekap),
    store: Object.assign(store, store),
    update: Object.assign(update, update),
    delete: Object.assign(deleteMethod, deleteMethod),
}

export default cuti