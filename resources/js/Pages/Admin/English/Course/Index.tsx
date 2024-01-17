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
import { Button } from "@material-tailwind/react";

export default function Index(props: any) {
    const {courses} = props
    const {data} = courses

    return (
        <MasterLayout>
            <Table>
                <TableCaption>A list of courses crazy.</TableCaption>
                <TableHeader>
                    <TableRow>
                        <TableHead>Image</TableHead>
                        <TableHead>Title</TableHead>
                        <TableHead>Description</TableHead>
                        <TableHead className="text-right"></TableHead>
                        <TableHead className="text-right"></TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                        {
                            data.map((item, key) => {
                               return <TableRow key={key}>
                                   <TableCell>
                                       <img src={item.small_thumb}  alt={item.name}/>
                                   </TableCell>
                                   <TableCell className="font-medium">{item.name}</TableCell>
                                   <TableCell>{item.description}</TableCell>
                                   <TableCell className="text-right">
                                       <Link href={route('course.edit', [item.id])}>
                                           <Button size={'sm'} color={'blue'}>Update</Button>
                                       </Link>
                                   </TableCell>
                                   <TableCell className="text-right">
                                       <Button size={'sm'} color={'red'}>Delete</Button>
                                   </TableCell>
                               </TableRow>
                            })
                        }
                </TableBody>
            </Table>

        </MasterLayout>
    )
}
