import { useEffect, useState } from 'react';
import GuestLayout from '@/Layouts/GuestLayout';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Head, Link, useForm } from '@inertiajs/react';

export default function Register() {
    const { data, setData, post, processing, errors, reset } = useForm({
        name : '',
        email: '',
        password: '',
        password_confirmation: '',
        logo: '',
    });

    const [preview, setPreview] = useState(null); // Added state for preview image

    useEffect(() => {
        return () => {
            reset('password', 'password_confirmation');
        };
    }, []);

    const submit = (e) => {
        e.preventDefault();

        post(route('register'));
    };

    return (
        <GuestLayout>
            <Head title="Register" />

            <form onSubmit={submit} className="space-y-6" enctype="multipart/form-data">
  
    <div>
        <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <InputLabel htmlFor="name" value="Name of Institution" />
                <TextInput
                    id="name"
                    name="name"
                    value={data.name}
                    className="mt-1 block w-full"
                    autoComplete="name"
                    isFocused={true}
                    onChange={(e) => setData('name', e.target.value)}
                    required
                />
                <InputError message={errors.name} className="mt-2" />
            </div>

            <div>
                <InputLabel htmlFor="email" value="Email" />
                <TextInput
                    id="email"
                    type="email"
                    name="email"
                    value={data.email}
                    className="mt-1 block w-full"
                    autoComplete="username"
                    onChange={(e) => setData('email', e.target.value)}
                    required
                />
                <InputError message={errors.email} className="mt-2" />
            </div>
        </div>
    </div>

  
    <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <InputLabel htmlFor="password" value="Password" />
            <TextInput
                id="password"
                type="password"
                name="password"
                value={data.password}
                className="mt-1 block w-full"
                autoComplete="new-password"
                onChange={(e) => setData('password', e.target.value)}
                required
            />
            <InputError message={errors.password} className="mt-2" />
        </div>

        <div>
            <InputLabel htmlFor="password_confirmation" value="Confirm Password" />
            <TextInput
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                value={data.password_confirmation}
                className="mt-1 block w-full"
                autoComplete="new-password"
                onChange={(e) => setData('password_confirmation', e.target.value)}
                required
            />
            <InputError message={errors.password_confirmation} className="mt-2" />
        </div>
    </div>

   
  
    <div className="flex justify-center mt-6">
        <div className="relative">
            <input
                id="logo"
                type="file"
                name="logo"
                className="absolute inset-0 opacity-0 cursor-pointer"
                onChange={(e) => {
                    const file = e.target.files[0];
                    setData('logo', file);

                    // Preview the image
                    if (file) {
                        const reader = new FileReader();
                        reader.onloadend = () => {
                            setPreview(reader.result); // Set the image preview
                        };
                        reader.readAsDataURL(file);
                    }
                }}
            />
            <div
                className={`w-32 h-32 rounded-full border-2 border-white flex items-center justify-center bg-blue-600`}
            >
                {preview ? (
                    <img
                        src={preview}
                        alt="Logo Preview"
                        className="w-full h-full object-cover rounded-full"
                    />
                ) : (
                    <span className="text-white text-center">Click to upload Your Logo of Institution</span>
                )}
            </div>
            <InputError message={errors.logo} className="mt-2" />
        </div>
    </div>


    <div className="flex items-center justify-end mt-4">
        <Link
            href={route('login')}
            className="underline text-sm text-gray-600 hover:text-blue-500 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        >
            Already registered?
        </Link>

        <PrimaryButton className="ms-4 bg-blue-900 hover:bg-blue-500" disabled={processing}>
            Register
        </PrimaryButton>
    </div>
</form>
        </GuestLayout>
    );
}
