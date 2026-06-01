import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\PegawaiController::index
* @see app/Http/Controllers/PegawaiController.php:14
* @route '/pegawai'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/pegawai',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\PegawaiController::index
* @see app/Http/Controllers/PegawaiController.php:14
* @route '/pegawai'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\PegawaiController::index
* @see app/Http/Controllers/PegawaiController.php:14
* @route '/pegawai'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\PegawaiController::index
* @see app/Http/Controllers/PegawaiController.php:14
* @route '/pegawai'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\PegawaiController::index
* @see app/Http/Controllers/PegawaiController.php:14
* @route '/pegawai'
*/
const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\PegawaiController::index
* @see app/Http/Controllers/PegawaiController.php:14
* @route '/pegawai'
*/
indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\PegawaiController::index
* @see app/Http/Controllers/PegawaiController.php:14
* @route '/pegawai'
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
* @see \App\Http\Controllers\PegawaiController::store
* @see app/Http/Controllers/PegawaiController.php:25
* @route '/pegawai'
*/
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/pegawai',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\PegawaiController::store
* @see app/Http/Controllers/PegawaiController.php:25
* @route '/pegawai'
*/
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\PegawaiController::store
* @see app/Http/Controllers/PegawaiController.php:25
* @route '/pegawai'
*/
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\PegawaiController::store
* @see app/Http/Controllers/PegawaiController.php:25
* @route '/pegawai'
*/
const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\PegawaiController::store
* @see app/Http/Controllers/PegawaiController.php:25
* @route '/pegawai'
*/
storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(options),
    method: 'post',
})

store.form = storeForm

/**
* @see \App\Http\Controllers\PegawaiController::update
* @see app/Http/Controllers/PegawaiController.php:55
* @route '/pegawai/{pegawai}'
*/
export const update = (args: { pegawai: number | { id: number } } | [pegawai: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put"],
    url: '/pegawai/{pegawai}',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\PegawaiController::update
* @see app/Http/Controllers/PegawaiController.php:55
* @route '/pegawai/{pegawai}'
*/
update.url = (args: { pegawai: number | { id: number } } | [pegawai: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { pegawai: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
        args = { pegawai: args.id }
    }

    if (Array.isArray(args)) {
        args = {
            pegawai: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        pegawai: typeof args.pegawai === 'object'
        ? args.pegawai.id
        : args.pegawai,
    }

    return update.definition.url
            .replace('{pegawai}', parsedArgs.pegawai.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\PegawaiController::update
* @see app/Http/Controllers/PegawaiController.php:55
* @route '/pegawai/{pegawai}'
*/
update.put = (args: { pegawai: number | { id: number } } | [pegawai: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

/**
* @see \App\Http\Controllers\PegawaiController::update
* @see app/Http/Controllers/PegawaiController.php:55
* @route '/pegawai/{pegawai}'
*/
const updateForm = (args: { pegawai: number | { id: number } } | [pegawai: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: update.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'PUT',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

/**
* @see \App\Http\Controllers\PegawaiController::update
* @see app/Http/Controllers/PegawaiController.php:55
* @route '/pegawai/{pegawai}'
*/
updateForm.put = (args: { pegawai: number | { id: number } } | [pegawai: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: update.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'PUT',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

update.form = updateForm

/**
* @see \App\Http\Controllers\PegawaiController::destroy
* @see app/Http/Controllers/PegawaiController.php:83
* @route '/pegawai/{pegawai}'
*/
export const destroy = (args: { pegawai: number | { id: number } } | [pegawai: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/pegawai/{pegawai}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\PegawaiController::destroy
* @see app/Http/Controllers/PegawaiController.php:83
* @route '/pegawai/{pegawai}'
*/
destroy.url = (args: { pegawai: number | { id: number } } | [pegawai: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { pegawai: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
        args = { pegawai: args.id }
    }

    if (Array.isArray(args)) {
        args = {
            pegawai: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        pegawai: typeof args.pegawai === 'object'
        ? args.pegawai.id
        : args.pegawai,
    }

    return destroy.definition.url
            .replace('{pegawai}', parsedArgs.pegawai.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\PegawaiController::destroy
* @see app/Http/Controllers/PegawaiController.php:83
* @route '/pegawai/{pegawai}'
*/
destroy.delete = (args: { pegawai: number | { id: number } } | [pegawai: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

/**
* @see \App\Http\Controllers\PegawaiController::destroy
* @see app/Http/Controllers/PegawaiController.php:83
* @route '/pegawai/{pegawai}'
*/
const destroyForm = (args: { pegawai: number | { id: number } } | [pegawai: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: destroy.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'DELETE',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

/**
* @see \App\Http\Controllers\PegawaiController::destroy
* @see app/Http/Controllers/PegawaiController.php:83
* @route '/pegawai/{pegawai}'
*/
destroyForm.delete = (args: { pegawai: number | { id: number } } | [pegawai: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: destroy.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'DELETE',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

destroy.form = destroyForm

/**
* @see \App\Http\Controllers\PegawaiController::exportCsv
* @see app/Http/Controllers/PegawaiController.php:94
* @route '/pegawai/export'
*/
export const exportCsv = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: exportCsv.url(options),
    method: 'get',
})

exportCsv.definition = {
    methods: ["get","head"],
    url: '/pegawai/export',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\PegawaiController::exportCsv
* @see app/Http/Controllers/PegawaiController.php:94
* @route '/pegawai/export'
*/
exportCsv.url = (options?: RouteQueryOptions) => {
    return exportCsv.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\PegawaiController::exportCsv
* @see app/Http/Controllers/PegawaiController.php:94
* @route '/pegawai/export'
*/
exportCsv.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: exportCsv.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\PegawaiController::exportCsv
* @see app/Http/Controllers/PegawaiController.php:94
* @route '/pegawai/export'
*/
exportCsv.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: exportCsv.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\PegawaiController::exportCsv
* @see app/Http/Controllers/PegawaiController.php:94
* @route '/pegawai/export'
*/
const exportCsvForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: exportCsv.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\PegawaiController::exportCsv
* @see app/Http/Controllers/PegawaiController.php:94
* @route '/pegawai/export'
*/
exportCsvForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: exportCsv.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\PegawaiController::exportCsv
* @see app/Http/Controllers/PegawaiController.php:94
* @route '/pegawai/export'
*/
exportCsvForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: exportCsv.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

exportCsv.form = exportCsvForm

/**
* @see \App\Http\Controllers\PegawaiController::importCsv
* @see app/Http/Controllers/PegawaiController.php:125
* @route '/pegawai/import'
*/
export const importCsv = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: importCsv.url(options),
    method: 'post',
})

importCsv.definition = {
    methods: ["post"],
    url: '/pegawai/import',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\PegawaiController::importCsv
* @see app/Http/Controllers/PegawaiController.php:125
* @route '/pegawai/import'
*/
importCsv.url = (options?: RouteQueryOptions) => {
    return importCsv.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\PegawaiController::importCsv
* @see app/Http/Controllers/PegawaiController.php:125
* @route '/pegawai/import'
*/
importCsv.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: importCsv.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\PegawaiController::importCsv
* @see app/Http/Controllers/PegawaiController.php:125
* @route '/pegawai/import'
*/
const importCsvForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: importCsv.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\PegawaiController::importCsv
* @see app/Http/Controllers/PegawaiController.php:125
* @route '/pegawai/import'
*/
importCsvForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: importCsv.url(options),
    method: 'post',
})

importCsv.form = importCsvForm

const PegawaiController = { index, store, update, destroy, exportCsv, importCsv }

export default PegawaiController