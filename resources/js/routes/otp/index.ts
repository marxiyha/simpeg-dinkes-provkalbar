import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../wayfinder'
/**
* @see \App\Http\Controllers\AuthController::form
* @see app/Http/Controllers/AuthController.php:98
* @route '/otp'
*/
export const form = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: form.url(options),
    method: 'get',
})

form.definition = {
    methods: ["get","head"],
    url: '/otp',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\AuthController::form
* @see app/Http/Controllers/AuthController.php:98
* @route '/otp'
*/
form.url = (options?: RouteQueryOptions) => {
    return form.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\AuthController::form
* @see app/Http/Controllers/AuthController.php:98
* @route '/otp'
*/
form.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: form.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\AuthController::form
* @see app/Http/Controllers/AuthController.php:98
* @route '/otp'
*/
form.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: form.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\AuthController::form
* @see app/Http/Controllers/AuthController.php:98
* @route '/otp'
*/
const formForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: form.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\AuthController::form
* @see app/Http/Controllers/AuthController.php:98
* @route '/otp'
*/
formForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: form.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\AuthController::form
* @see app/Http/Controllers/AuthController.php:98
* @route '/otp'
*/
formForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: form.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

form.form = formForm

/**
* @see \App\Http\Controllers\AuthController::verify
* @see app/Http/Controllers/AuthController.php:133
* @route '/otp/verify'
*/
export const verify = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: verify.url(options),
    method: 'post',
})

verify.definition = {
    methods: ["post"],
    url: '/otp/verify',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\AuthController::verify
* @see app/Http/Controllers/AuthController.php:133
* @route '/otp/verify'
*/
verify.url = (options?: RouteQueryOptions) => {
    return verify.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\AuthController::verify
* @see app/Http/Controllers/AuthController.php:133
* @route '/otp/verify'
*/
verify.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: verify.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AuthController::verify
* @see app/Http/Controllers/AuthController.php:133
* @route '/otp/verify'
*/
const verifyForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: verify.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AuthController::verify
* @see app/Http/Controllers/AuthController.php:133
* @route '/otp/verify'
*/
verifyForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: verify.url(options),
    method: 'post',
})

verify.form = verifyForm

/**
* @see \App\Http\Controllers\AuthController::verifyDirect
* @see app/Http/Controllers/AuthController.php:133
* @route '/otp-verify'
*/
export const verifyDirect = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: verifyDirect.url(options),
    method: 'post',
})

verifyDirect.definition = {
    methods: ["post"],
    url: '/otp-verify',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\AuthController::verifyDirect
* @see app/Http/Controllers/AuthController.php:133
* @route '/otp-verify'
*/
verifyDirect.url = (options?: RouteQueryOptions) => {
    return verifyDirect.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\AuthController::verifyDirect
* @see app/Http/Controllers/AuthController.php:133
* @route '/otp-verify'
*/
verifyDirect.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: verifyDirect.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AuthController::verifyDirect
* @see app/Http/Controllers/AuthController.php:133
* @route '/otp-verify'
*/
const verifyDirectForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: verifyDirect.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AuthController::verifyDirect
* @see app/Http/Controllers/AuthController.php:133
* @route '/otp-verify'
*/
verifyDirectForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: verifyDirect.url(options),
    method: 'post',
})

verifyDirect.form = verifyDirectForm

/**
* @see \App\Http\Controllers\AuthController::resend
* @see app/Http/Controllers/AuthController.php:113
* @route '/otp/resend'
*/
export const resend = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: resend.url(options),
    method: 'post',
})

resend.definition = {
    methods: ["post"],
    url: '/otp/resend',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\AuthController::resend
* @see app/Http/Controllers/AuthController.php:113
* @route '/otp/resend'
*/
resend.url = (options?: RouteQueryOptions) => {
    return resend.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\AuthController::resend
* @see app/Http/Controllers/AuthController.php:113
* @route '/otp/resend'
*/
resend.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: resend.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AuthController::resend
* @see app/Http/Controllers/AuthController.php:113
* @route '/otp/resend'
*/
const resendForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: resend.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AuthController::resend
* @see app/Http/Controllers/AuthController.php:113
* @route '/otp/resend'
*/
resendForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: resend.url(options),
    method: 'post',
})

resend.form = resendForm

const otp = {
    form: Object.assign(form, form),
    verify: Object.assign(verify, verify),
    verifyDirect: Object.assign(verifyDirect, verifyDirect),
    resend: Object.assign(resend, resend),
}

export default otp