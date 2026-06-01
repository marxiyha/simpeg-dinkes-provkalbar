import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../wayfinder'
/**
* @see \App\Http\Controllers\AuthController::post
* @see app/Http/Controllers/AuthController.php:36
* @route '/login/petinggi'
*/
export const post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: post.url(options),
    method: 'post',
})

post.definition = {
    methods: ["post"],
    url: '/login/petinggi',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\AuthController::post
* @see app/Http/Controllers/AuthController.php:36
* @route '/login/petinggi'
*/
post.url = (options?: RouteQueryOptions) => {
    return post.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\AuthController::post
* @see app/Http/Controllers/AuthController.php:36
* @route '/login/petinggi'
*/
post.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: post.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AuthController::post
* @see app/Http/Controllers/AuthController.php:36
* @route '/login/petinggi'
*/
const postForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: post.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AuthController::post
* @see app/Http/Controllers/AuthController.php:36
* @route '/login/petinggi'
*/
postForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: post.url(options),
    method: 'post',
})

post.form = postForm
