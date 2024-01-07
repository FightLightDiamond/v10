import {Button} from "@/shadcn/ui/button";
import {
    Card,
    CardContent,
    CardFooter,
    CardHeader,
    CardTitle,
} from "@/shadcn/ui/card"
import {router} from "@inertiajs/react";
import {useState} from "react";
import {Input} from "@/shadcn/ui/input";

const Create = () => {
    const [values, setValues] = useState({
        name: "",
        description: "",
    })

    function handleChange(e: any) {
        const key = e.target.id;
        const value = e.target.value
        setValues(values => ({
            ...values,
            [key]: value,
        }))
    }

    function handleSubmit(e: any) {
        e.preventDefault()
        router.post('/items', values)
    }

    return (
        <div>
            <Card>
                <CardHeader>
                    <CardTitle>Tạo vũ khí</CardTitle>
                </CardHeader>
                <CardContent>
                    <form onSubmit={handleSubmit}>
                        <label htmlFor="name">Tên:</label>
                        <Input id="name" value={values.name} onChange={handleChange} />
                        <label htmlFor="description">Thông tin:</label>
                        <Input id="description" value={values.description} onChange={handleChange} />
                        <Button type="submit">Tạo</Button>
                    </form>
                </CardContent>
                <CardFooter>
                </CardFooter>
            </Card>
        </div>
    )
}

export default Create
