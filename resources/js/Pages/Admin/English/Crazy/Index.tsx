import MasterLayout from "@/Layouts/MasterLayout";
import {Link} from "@inertiajs/react";
import {Button, Input, Option, Select} from "@material-tailwind/react";
import { Card, Typography } from "@material-tailwind/react";
export default function Index(props: any) {
    const {courses} = props

    const TABLE_HEAD = ["Name", "Job", "Employed", "", ""];

    const TABLE_ROWS = [
        {
            name: "John Michael",
            job: "Manager",
            date: "23/04/18",
        },
        {
            name: "Alexa Liras",
            job: "Developer",
            date: "23/04/18",
        },
        {
            name: "Laurent Perrier",
            job: "Executive",
            date: "19/09/17",
        },
        {
            name: "Michael Levi",
            job: "Developer",
            date: "24/12/08",
        },
        {
            name: "Richard Gran",
            job: "Manager",
            date: "04/10/21",
        },
    ];

    return (
        <MasterLayout>
            <div className={'flex flex-row gap-4 mb-4'}>
                <div className="">
                    <Select variant="static" label="Name">
                        {courses.map((item, key) => <Option key={key}>{item.name}</Option>) }
                    </Select>
                </div>
                <div className="grow">
                    <Input className="w-full" label="Title" placeholder="title"/>
                </div>
                <div className="">
                    <Button size={'sm'} color="green">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
                            <path strokeLinecap="round" strokeLinejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </Button>
                </div>
            </div>

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
                {TABLE_ROWS.map(({ name, job, date }, index) => (
                    <tr key={name} className="even:bg-blue-gray-50/50">
                        <td className="p-4">
                            <Typography variant="small" color="blue-gray" className="font-normal">
                                {name}
                            </Typography>
                        </td>
                        <td className="p-4">
                            <Typography variant="small" color="blue-gray" className="font-normal">
                                {job}
                            </Typography>
                        </td>
                        <td className="p-4">
                            <Typography variant="small" color="blue-gray" className="font-normal">
                                {date}
                            </Typography>
                        </td>
                        <td className="p-4">
                            <Typography as="a" href="#" variant="small" color="blue-gray" className="font-medium">
                                Edit
                            </Typography>
                        </td>
                        <td className="p-4">
                            <Typography as="a" href="#" variant="small" color="blue-gray" className="font-medium">
                                Delete
                            </Typography>
                        </td>
                    </tr>
                ))}
                </tbody>
            </table>
        </MasterLayout>
    )
}


