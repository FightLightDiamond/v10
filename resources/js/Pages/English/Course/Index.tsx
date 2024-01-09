import MasterLayout from "@/Layouts/MasterLayout";
import {Link} from "@inertiajs/react";

export default function Index(props: any) {
    const {courses} = props

    console.log(courses)

    return (
        <MasterLayout>


            <ul role="list" className="divide-y divide-gray-100">
                {courses.map((course, key: number) => (
                    <li key={key} className="flex justify-between gap-x-6 py-5">
                        <div className="flex min-w-0 gap-x-4">
                            <img className="h-12 w-12 flex-none rounded-full bg-gray-50" src={course.small_thumb} alt="" />
                            <div className="min-w-0 flex-auto">
                                <Link href={route('crazy-course.show', course.id)}>
                                    <p className="text-sm font-semibold leading-6 text-gray-900">{course.name}</p>
                                </Link>
                                <p className="mt-1 truncate text-xs leading-5 text-gray-500">{course.description}</p>
                            </div>
                        </div>
                        <div className="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                            <p className="text-sm leading-6 text-gray-900">{course.role}</p>
                            <p className="mt-1 text-xs leading-5 text-gray-500">
                                Last seen {course.updated_at} :{course.created_by?.email}
                            </p>
                        </div>
                    </li>
                ))}
            </ul>
        </MasterLayout>
    )
}
