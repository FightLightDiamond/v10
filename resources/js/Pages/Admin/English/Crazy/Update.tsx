import MasterLayout from "@/Layouts/MasterLayout";
import {useState} from "react";
import {router, useForm} from "@inertiajs/react";
import {Input, Button} from "@material-tailwind/react";

import {Card, Typography} from "@material-tailwind/react";

const TABLE_HEAD = ["#", "Time", "Sentence", "Meaning", "IPA", ""];

export default function Index(props: any) {
    const {crazy} = props

    const {data, setData, post, progress} = useForm(crazy)

    function handleChange({ target }) {
        const {name, value} = target

        const a = name.match(/([^\[]+)\[(\d+)\]/);

        console.log(a, value)

        setData(data => ({
            ...data,
            [name]: value,
        }))
    }

    function handleSubmit(e) {
        e.preventDefault()
        router.post('/users', data)
    }

    return (
        <MasterLayout>
            <form onSubmit={handleSubmit} className="mb-4">
                <div className="mb-4">
                    <div className="mb-4">
                        <Input label="name" className="mb-4" id="name" defaultValue={data.name}
                               onChange={handleChange}/>
                    </div>
                    <div className="mb-4">
                        <Input label='Audio' type="file" className="mb-4" defaultValue={data.avatar}
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
                        {data.details.map(({id, sentence, meaning, time, ipa}, index) => (
                            <tr key={index} className="even:bg-blue-gray-50/50">
                                <td className="p-4">
                                    {index+1}
                                </td>
                                <td className="p-4 w-24">
                                    <Input defaultValue={time} label="Time"/>
                                </td>
                                <td className="p-4">
                                    <Input id={`sentence[${id}]`} name={`sentence[${id}]`} onChange={handleChange} defaultValue={sentence} label="Sentence"/>
                                </td>
                                <td className="p-4">
                                    <Input name={'meaning'+[id]} onChange={handleChange} defaultValue={meaning} label="Meaning"/>
                                </td>
                                <td className="p-4">
                                    <Input _name="ipa" _id={id} onChange={handleChange} defaultValue={ipa} label="IPA" />
                                </td>
                                <td className="p-4">
                                   <Button color="red">Delete</Button>
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

