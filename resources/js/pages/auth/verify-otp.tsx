import { Head, useForm, Link, router } from '@inertiajs/react';
import { useState, useEffect } from 'react';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';

export default function VerifyOtp() {
    const { data, setData, post, processing, errors } = useForm({
        otp: '',
    });

    const [secondsLeft, setSecondsLeft] = useState(300);
    const [isResending, setIsResending] = useState(false);

    useEffect(() => {
        if (secondsLeft <= 0) return;
        const timer = setInterval(() => {
            setSecondsLeft((prev) => prev - 1);
        }, 1000);
        return () => clearInterval(timer);
    }, [secondsLeft]);

    const formatTime = (seconds: number) => {
        const m = Math.floor(seconds / 60).toString().padStart(2, '0');
        const s = (seconds % 60).toString().padStart(2, '0');
        return `${m}:${s}`;
    };

    const submit = (e: React.FormEvent) => {
        e.preventDefault();
        post('/otp-verify');
    };

    const handleResend = (e: React.MouseEvent) => {
        e.preventDefault();
        setIsResending(true);
        router.post('/otp/resend', {}, {
            onSuccess: () => {
                setSecondsLeft(300);
                setIsResending(false);
            },
            onError: () => {
                setIsResending(false);
            }
        });
    };

    return (
        <>
            <Head title="Two-Factor Authentication" />

            <form onSubmit={submit} className="flex flex-col gap-6">
                <div className="grid gap-6">
                    <div className="grid gap-2">
                        <div className="flex justify-between items-center">
                            <Label htmlFor="otp">Kode OTP</Label>
                            <span className={`text-sm font-medium ${secondsLeft === 0 ? 'text-destructive' : 'text-muted-foreground'}`}>
                                {secondsLeft > 0 ? `Sisa waktu: ${formatTime(secondsLeft)}` : 'OTP Kedaluwarsa'}
                            </span>
                        </div>
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
                            className="text-center tracking-[0.5em] text-lg font-mono"
                            disabled={secondsLeft === 0}
                        />
                        {secondsLeft === 0 && (
                            <p className="text-sm text-destructive mt-1">
                                Kode OTP telah kedaluwarsa. Silakan klik tombol "Kirim Ulang OTP" di bawah untuk mendapatkan kode baru.
                            </p>
                        )}
                        <InputError message={errors.otp} />
                    </div>

                    <div className="flex flex-col gap-2 mt-4">
                        <Button
                            type="submit"
                            className="w-full"
                            disabled={processing || secondsLeft === 0}
                        >
                            {processing && <Spinner />}
                            Verifikasi & Lanjutkan
                        </Button>

                        <div className="flex gap-4 mt-2">
                            <Button
                                type="button"
                                variant="outline"
                                className="w-full"
                                onClick={handleResend}
                                disabled={secondsLeft > 0 || isResending}
                            >
                                {isResending && <Spinner />}
                                Kirim Ulang OTP
                            </Button>
                        </div>
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
