import MasterLayout from "@/Layouts/MasterLayout";
import {useState} from "react";
import {router, useForm} from "@inertiajs/react";
import {Input, Button} from "@material-tailwind/react";

import {Card, Typography} from "@material-tailwind/react";

const TABLE_HEAD = ["#", "Time", "Sentence", "Meaning", "API", "-"];

export default function Index(props: any) {
    const {crazy} = props
    const [values, setValues] = useState({
        first_name: "",
        last_name: "",
        email: "",
    })

    const {data, setData, post, progress} = useForm({
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
            <form onSubmit={handleSubmit} className="mb-4">
                <div className="mb-4">
                    <div className="mb-4">
                        <Input label="name" className="mb-4" id="first_name" value={values.first_name}
                               onChange={handleChange}/>
                    </div>
                    <div className="mb-4">
                        <Input label='Audio' type="file" className="mb-4" value={data.avatar}
                               onChange={e => setData('avatar', e.target.files[0])}/>
                        {progress && (
                            <progress value={progress.percentage} max="100">
                                {progress.percentage}%
                            </progress>
                        )}
                    </div>
                    <div className="mb-4">
                        <audio src="" controls/>
                    </div>

                </div>
                <Card className="h-full w-full overflow-scroll mb-4">
                    <table className="w-full min-w-max table-auto text-left">
                        <thead>
                        <tr>
                            {TABLE_HEAD.map((head) => (
                                <th key={head} className="border-b border-blue-gray-100 bg-blue-gray-50 p-4">
                                    <Typography
                                        variant="small"
                                        color="blue-gray"
                                        className="font-normal leading-none opacity-70"
                                    >
                                        {head}
                                    </Typography>
                                </th>
                            ))}
                        </tr>
                        </thead>
                        <tbody>
                        {crazy.details.map(({sentence, meaning, time, ipa}, index) => (
                            <tr key={index} className="even:bg-blue-gray-50/50">
                                <td className="p-4">
                                    {index+1}
                                </td>
                                <td className="p-4 w-24">
                                    <Input value={time} label="Time"/>
                                </td>
                                <td className="p-4">
                                    <Typography variant="small" color="blue-gray" className="font-normal">
                                        <Input value={sentence} label="Sentence"/>
                                    </Typography>
                                </td>
                                <td className="p-4">
                                    <Typography variant="small" color="blue-gray" className="font-normal">
                                        <Input value={meaning} label="Sentence"/>
                                    </Typography>
                                </td>
                                <td className="p-4">
                                    <Typography as="a" href="#" variant="small" color="blue-gray"
                                                className="font-medium">
                                        <Input value={sentence} label="IPA" />
                                    </Typography>
                                </td>
                                <td className="p-4">
                                    <Typography as="a" href="#" variant="small" color="blue-gray"
                                                className="font-medium">
                                        <Input value={sentence} label="IPA" />
                                    </Typography>
                                </td>
                            </tr>
                        ))}
                        </tbody>
                    </table>
                </Card>

                <Button type="submit">Submit</Button>
            </form>
        </MasterLayout>
    )
}

