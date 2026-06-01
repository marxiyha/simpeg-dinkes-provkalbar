import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../wayfinder'
/**
* @see routes/web.php:157
* @route '/hapus-akun'
*/
export const akun = (options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: akun.url(options),
    method: 'delete',
})

akun.definition = {
    methods: ["delete"],
    url: '/hapus-akun',
} satisfies RouteDefinition<["delete"]>

/**
* @see routes/web.php:157
* @route '/hapus-akun'
*/
akun.url = (options?: RouteQueryOptions) => {
    return akun.definition.url + queryParams(options)
}

/**
* @see routes/web.php:157
* @route '/hapus-akun'
*/
akun.delete = (options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: akun.url(options),
    method: 'delete',
})

/**
* @see routes/web.php:157
* @route '/hapus-akun'
*/
const akunForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: akun.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'DELETE',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

/**
* @see routes/web.php:157
* @route '/hapus-akun'
*/
akunForm.delete = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: akun.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'DELETE',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

akun.form = akunForm

const hapus = {
    akun: Object.assign(akun, akun),
}

export default hapus