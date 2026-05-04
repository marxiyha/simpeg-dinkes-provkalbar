import { Head, useForm } from '@inertiajs/react';
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
                        <Label htmlFor="otp">Authentication Code</Label>
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

                    <Button
                        type="submit"
                        className="mt-4 w-full"
                        disabled={processing}
                    >
                        {processing && <Spinner />}
                        Verify & Continue
                    </Button>
                </div>
            </form>
        </>
    );
}

VerifyOtp.layout = {
    title: 'Two-Factor Authentication',
    description: 'Please enter the 6-digit OTP sent to your email to continue.',
};
