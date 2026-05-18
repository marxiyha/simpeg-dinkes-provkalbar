import { Head, useForm, Link } from '@inertiajs/react';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';

export default function VerifyOtp() {
    const { data, setData, post, processing, errors } = useForm({
        otp: '',
    });

    const submit = (e: React.FormEvent) => {
        e.preventDefault();
        // Since we bypassed Ziggy/Wayfinder route generation for now, just use direct URL path
        post('/otp-verify');
    };

    return (
        <>
            <Head title="Two-Factor Authentication" />

            <form onSubmit={submit} className="flex flex-col gap-6">
                <div className="grid gap-6">
                    <div className="grid gap-2">
                        <Label htmlFor="otp">Kode OTP</Label>
                        <Input
                            id="otp"
                            type="text"
                            name="otp"
                            required
                            autoFocus
                            maxLength={6}
                            value={data.otp}
                            onChange={(e) => setData('otp', e.target.value)}
                            placeholder="123456"
                        />
                        <InputError message={errors.otp} />
                    </div>

                    <div className="flex flex-col gap-2 mt-4">
                        <Button
                            type="submit"
                            className="w-full"
                            disabled={processing}
                        >
                            {processing && <Spinner />}
                            Verifikasi & Lanjutkan
                        </Button>
                        <Link
                            href="/logout"
                            method="post"
                            as="button"
                            className="text-sm text-center text-muted-foreground hover:text-foreground mt-2 w-full"
                        >
                            Batal dan kembali ke Login
                        </Link>
                    </div>
                </div>
            </form>
        </>
    );
}

VerifyOtp.layout = {
    title: 'Two-Factor Authentication',
    description: 'Masukkan kode OTP 6 angka untuk melanjutkan.',
};
