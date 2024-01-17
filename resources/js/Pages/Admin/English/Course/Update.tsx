import MasterLayout from "@/Layouts/MasterLayout";
import {useState} from "react";
import {router, useForm} from "@inertiajs/react";
import {Input, Button} from "@material-tailwind/react";


export default function Index(props: any) {
    const [values, setValues] = useState({
        first_name: "",
        last_name: "",
        email: "",
    })

    const { data, setData, post, progress } = useForm({
        name: null,
        avatar: null,
    })

    function handleChange(e) {
        const key = e.target.id;
        const value = e.target.value
        setValues(values => ({
            ...values,
            [key]: value,
        }))
    }

    function handleSubmit(e) {
        e.preventDefault()
        router.post('/users', values)
    }

    return (
        <MasterLayout>
            <form onSubmit={handleSubmit}>
                <div className="mb-2">
                    <label htmlFor="first_name">First name:</label>
                    <Input id="first_name" value={values.first_name} onChange={handleChange} />
                    <label htmlFor="last_name">Last name:</label>
                    <Input id="last_name" value={values.last_name} onChange={handleChange} />
                    <label htmlFor="email">Email:</label>
                    <Input id="email" value={values.email} onChange={handleChange} />
                    <Input type="file" value={data.avatar} onChange={e => setData('avatar', e.target.files[0])} />
                    {progress && (
                        <progress value={progress.percentage} max="100">
                            {progress.percentage}%
                        </progress>
                    )}
                </div>

                <Button type="submit">Submit</Button>
            </form>
        </MasterLayout>
    )
}
