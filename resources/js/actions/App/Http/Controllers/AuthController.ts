import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\AuthController::logout
* @see app/Http/Controllers/AuthController.php:157
* @route '/logout'
*/
export const logout = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: logout.url(options),
    method: 'post',
})

logout.definition = {
    methods: ["post"],
    url: '/logout',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\AuthController::logout
* @see app/Http/Controllers/AuthController.php:157
* @route '/logout'
*/
logout.url = (options?: RouteQueryOptions) => {
    return logout.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\AuthController::logout
* @see app/Http/Controllers/AuthController.php:157
* @route '/logout'
*/
logout.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: logout.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AuthController::logout
* @see app/Http/Controllers/AuthController.php:157
* @route '/logout'
*/
const logoutForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: logout.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AuthController::logout
* @see app/Http/Controllers/AuthController.php:157
* @route '/logout'
*/
logoutForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: logout.url(options),
    method: 'post',
})

logout.form = logoutForm

/**
* @see \App\Http\Controllers\AuthController::updatePassword
* @see app/Http/Controllers/AuthController.php:149
* @route '/forgot-password'
*/
export const updatePassword = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: updatePassword.url(options),
    method: 'post',
})

updatePassword.definition = {
    methods: ["post"],
    url: '/forgot-password',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\AuthController::updatePassword
* @see app/Http/Controllers/AuthController.php:149
* @route '/forgot-password'
*/
updatePassword.url = (options?: RouteQueryOptions) => {
    return updatePassword.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\AuthController::updatePassword
* @see app/Http/Controllers/AuthController.php:149
* @route '/forgot-password'
*/
updatePassword.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: updatePassword.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AuthController::updatePassword
* @see app/Http/Controllers/AuthController.php:149
* @route '/forgot-password'
*/
const updatePasswordForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: updatePassword.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AuthController::updatePassword
* @see app/Http/Controllers/AuthController.php:149
* @route '/forgot-password'
*/
updatePasswordForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: updatePassword.url(options),
    method: 'post',
})

updatePassword.form = updatePasswordForm

/**
* @see \App\Http\Controllers\AuthController::register
* @see app/Http/Controllers/AuthController.php:14
* @route '/register'
*/
export const register = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: register.url(options),
    method: 'post',
})

register.definition = {
    methods: ["post"],
    url: '/register',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\AuthController::register
* @see app/Http/Controllers/AuthController.php:14
* @route '/register'
*/
register.url = (options?: RouteQueryOptions) => {
    return register.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\AuthController::register
* @see app/Http/Controllers/AuthController.php:14
* @route '/register'
*/
register.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: register.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AuthController::register
* @see app/Http/Controllers/AuthController.php:14
* @route '/register'
*/
const registerForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: register.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AuthController::register
* @see app/Http/Controllers/AuthController.php:14
* @route '/register'
*/
registerForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: register.url(options),
    method: 'post',
})

register.form = registerForm

/**
* @see \App\Http\Controllers\AuthController::loginPetinggi
* @see app/Http/Controllers/AuthController.php:36
* @route '/login/petinggi'
*/
export const loginPetinggi = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: loginPetinggi.url(options),
    method: 'post',
})

loginPetinggi.definition = {
    methods: ["post"],
    url: '/login/petinggi',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\AuthController::loginPetinggi
* @see app/Http/Controllers/AuthController.php:36
* @route '/login/petinggi'
*/
loginPetinggi.url = (options?: RouteQueryOptions) => {
    return loginPetinggi.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\AuthController::loginPetinggi
* @see app/Http/Controllers/AuthController.php:36
* @route '/login/petinggi'
*/
loginPetinggi.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: loginPetinggi.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AuthController::loginPetinggi
* @see app/Http/Controllers/AuthController.php:36
* @route '/login/petinggi'
*/
const loginPetinggiForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: loginPetinggi.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AuthController::loginPetinggi
* @see app/Http/Controllers/AuthController.php:36
* @route '/login/petinggi'
*/
loginPetinggiForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: loginPetinggi.url(options),
    method: 'post',
})

loginPetinggi.form = loginPetinggiForm

/**
* @see \App\Http\Controllers\AuthController::loginPegawai
* @see app/Http/Controllers/AuthController.php:67
* @route '/login/pegawai'
*/
export const loginPegawai = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: loginPegawai.url(options),
    method: 'post',
})

loginPegawai.definition = {
    methods: ["post"],
    url: '/login/pegawai',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\AuthController::loginPegawai
* @see app/Http/Controllers/AuthController.php:67
* @route '/login/pegawai'
*/
loginPegawai.url = (options?: RouteQueryOptions) => {
    return loginPegawai.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\AuthController::loginPegawai
* @see app/Http/Controllers/AuthController.php:67
* @route '/login/pegawai'
*/
loginPegawai.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: loginPegawai.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AuthController::loginPegawai
* @see app/Http/Controllers/AuthController.php:67
* @route '/login/pegawai'
*/
const loginPegawaiForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: loginPegawai.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AuthController::loginPegawai
* @see app/Http/Controllers/AuthController.php:67
* @route '/login/pegawai'
*/
loginPegawaiForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: loginPegawai.url(options),
    method: 'post',
})

loginPegawai.form = loginPegawaiForm

/**
* @see \App\Http\Controllers\AuthController::otpForm
* @see app/Http/Controllers/AuthController.php:98
* @route '/otp'
*/
export const otpForm = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: otpForm.url(options),
    method: 'get',
})

otpForm.definition = {
    methods: ["get","head"],
    url: '/otp',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\AuthController::otpForm
* @see app/Http/Controllers/AuthController.php:98
* @route '/otp'
*/
otpForm.url = (options?: RouteQueryOptions) => {
    return otpForm.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\AuthController::otpForm
* @see app/Http/Controllers/AuthController.php:98
* @route '/otp'
*/
otpForm.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: otpForm.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\AuthController::otpForm
* @see app/Http/Controllers/AuthController.php:98
* @route '/otp'
*/
otpForm.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: otpForm.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\AuthController::otpForm
* @see app/Http/Controllers/AuthController.php:98
* @route '/otp'
*/
const otpFormForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: otpForm.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\AuthController::otpForm
* @see app/Http/Controllers/AuthController.php:98
* @route '/otp'
*/
otpFormForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: otpForm.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\AuthController::otpForm
* @see app/Http/Controllers/AuthController.php:98
* @route '/otp'
*/
otpFormForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: otpForm.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

otpForm.form = otpFormForm

/**
* @see \App\Http\Controllers\AuthController::verifyOtp
* @see app/Http/Controllers/AuthController.php:133
* @route '/otp/verify'
*/
const verifyOtpc87205b5d34af68c3a1676f466523d89 = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: verifyOtpc87205b5d34af68c3a1676f466523d89.url(options),
    method: 'post',
})

verifyOtpc87205b5d34af68c3a1676f466523d89.definition = {
    methods: ["post"],
    url: '/otp/verify',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\AuthController::verifyOtp
* @see app/Http/Controllers/AuthController.php:133
* @route '/otp/verify'
*/
verifyOtpc87205b5d34af68c3a1676f466523d89.url = (options?: RouteQueryOptions) => {
    return verifyOtpc87205b5d34af68c3a1676f466523d89.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\AuthController::verifyOtp
* @see app/Http/Controllers/AuthController.php:133
* @route '/otp/verify'
*/
verifyOtpc87205b5d34af68c3a1676f466523d89.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: verifyOtpc87205b5d34af68c3a1676f466523d89.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AuthController::verifyOtp
* @see app/Http/Controllers/AuthController.php:133
* @route '/otp/verify'
*/
const verifyOtpc87205b5d34af68c3a1676f466523d89Form = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: verifyOtpc87205b5d34af68c3a1676f466523d89.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AuthController::verifyOtp
* @see app/Http/Controllers/AuthController.php:133
* @route '/otp/verify'
*/
verifyOtpc87205b5d34af68c3a1676f466523d89Form.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: verifyOtpc87205b5d34af68c3a1676f466523d89.url(options),
    method: 'post',
})

verifyOtpc87205b5d34af68c3a1676f466523d89.form = verifyOtpc87205b5d34af68c3a1676f466523d89Form
/**
* @see \App\Http\Controllers\AuthController::verifyOtp
* @see app/Http/Controllers/AuthController.php:133
* @route '/otp-verify'
*/
const verifyOtpa578e14944c6ec33d5f977a9d3e56275 = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: verifyOtpa578e14944c6ec33d5f977a9d3e56275.url(options),
    method: 'post',
})

verifyOtpa578e14944c6ec33d5f977a9d3e56275.definition = {
    methods: ["post"],
    url: '/otp-verify',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\AuthController::verifyOtp
* @see app/Http/Controllers/AuthController.php:133
* @route '/otp-verify'
*/
verifyOtpa578e14944c6ec33d5f977a9d3e56275.url = (options?: RouteQueryOptions) => {
    return verifyOtpa578e14944c6ec33d5f977a9d3e56275.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\AuthController::verifyOtp
* @see app/Http/Controllers/AuthController.php:133
* @route '/otp-verify'
*/
verifyOtpa578e14944c6ec33d5f977a9d3e56275.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: verifyOtpa578e14944c6ec33d5f977a9d3e56275.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AuthController::verifyOtp
* @see app/Http/Controllers/AuthController.php:133
* @route '/otp-verify'
*/
const verifyOtpa578e14944c6ec33d5f977a9d3e56275Form = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: verifyOtpa578e14944c6ec33d5f977a9d3e56275.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AuthController::verifyOtp
* @see app/Http/Controllers/AuthController.php:133
* @route '/otp-verify'
*/
verifyOtpa578e14944c6ec33d5f977a9d3e56275Form.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: verifyOtpa578e14944c6ec33d5f977a9d3e56275.url(options),
    method: 'post',
})

verifyOtpa578e14944c6ec33d5f977a9d3e56275.form = verifyOtpa578e14944c6ec33d5f977a9d3e56275Form

export const verifyOtp = {
    '/otp/verify': verifyOtpc87205b5d34af68c3a1676f466523d89,
    '/otp-verify': verifyOtpa578e14944c6ec33d5f977a9d3e56275,
}

/**
* @see \App\Http\Controllers\AuthController::resendOtp
* @see app/Http/Controllers/AuthController.php:113
* @route '/otp/resend'
*/
export const resendOtp = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: resendOtp.url(options),
    method: 'post',
})

resendOtp.definition = {
    methods: ["post"],
    url: '/otp/resend',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\AuthController::resendOtp
* @see app/Http/Controllers/AuthController.php:113
* @route '/otp/resend'
*/
resendOtp.url = (options?: RouteQueryOptions) => {
    return resendOtp.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\AuthController::resendOtp
* @see app/Http/Controllers/AuthController.php:113
* @route '/otp/resend'
*/
resendOtp.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: resendOtp.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AuthController::resendOtp
* @see app/Http/Controllers/AuthController.php:113
* @route '/otp/resend'
*/
const resendOtpForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: resendOtp.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AuthController::resendOtp
* @see app/Http/Controllers/AuthController.php:113
* @route '/otp/resend'
*/
resendOtpForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: resendOtp.url(options),
    method: 'post',
})

resendOtp.form = resendOtpForm

const AuthController = { logout, updatePassword, register, loginPetinggi, loginPegawai, otpForm, verifyOtp, resendOtp }

export default AuthController