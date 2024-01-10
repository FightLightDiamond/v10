import MasterLayout from "@/Layouts/MasterLayout";
import {Link} from "@inertiajs/react";
import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/shadcn/ui/table"
import {useRef, useState} from "react";

export default function Read(props: any) {
    const {crazy} = props

    const [people, setPeople] = useState(crazy.details)

    console.log(crazy)

    const dragPerson = useRef<number>(0)
    const draggedOverPerson = useRef<number>(0)

    function handleSort() {
        const peopleClone = [...people]
        const temp = peopleClone[dragPerson.current]
        peopleClone[dragPerson.current] = peopleClone[draggedOverPerson.current]
        peopleClone[draggedOverPerson.current] = temp
        setPeople(peopleClone)
    }

    return (
        <MasterLayout>
            <h2 className={'text-xl font-semibold text-gray-900'}>{crazy.name}</h2>
            <div className={'text-sm'}>
                {crazy.description}
            </div>
            <audio src={crazy.audio} controls/>
            <ul className="list-decimal list-inside">
                {people.map((detail, index: number) => (
                <li key={index} className='hover:shadow-md hover:shadow-cyan-500/50'
                    draggable
                    onDragStart={() => (dragPerson.current = index)}
                    onDragEnter={() => (draggedOverPerson.current = index)}
                    onDragEnd={handleSort}
                    onDragOver={(e) => e.preventDefault()}
                >
                    {detail.sentence}
                </li>
                ))}
            </ul>


            <h2 className={'text-xl font-semibold text-gray-900'}>Danh sách các bài học</h2>
            <ul role="list" className="divide-y divide-gray-100">
                {crazy.crazy_course.crazies.map((crazy, key: number) => (
                    <li key={key} className="flex justify-between gap-x-6 py-5">
                        <div className="flex min-w-0 gap-x-4">
                            <img className="h-12 w-12 flex-none rounded-full bg-gray-50" src={crazy.small_thumb} alt="" />
                            <div className="min-w-0 flex-auto">
                                <Link href={route('crazy-course.read', crazy.id)}>
                                    <p className="text-sm font-semibold leading-6 text-gray-900">{crazy.name}</p>
                                </Link>
                                <p className="mt-1 truncate text-xs leading-5 text-gray-500">{crazy.description}</p>
                            </div>
                        </div>
                        <div className="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                            <p className="text-sm leading-6 text-gray-900">{crazy.role}</p>
                            <p className="mt-1 text-xs leading-5 text-gray-500">
                                Last seen {crazy.updated_at} :{crazy.created_by?.email}
                            </p>
                        </div>
                    </li>
                ))}
            </ul>
        </MasterLayout>
    )
}
