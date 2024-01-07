import {memo, useState} from "react";
import {Button} from "@/shadcn/ui/button";
import {Textarea} from "@/shadcn/ui/textarea";

const Alphabet = () => {
    const [text, setText] = useState('');

    /**
     * Method
     * @param text
     */
    const onSpeak = (text: string) => {
        const audio = new Audio('http://localhost:8000/speaks?text=' + text);
        audio.play();
    }

    const onClick = () => {
        onSpeak(text)
    }

    const alphabet = Array.from({ length: 26 }, (_, index) => String.fromCharCode(97 + index));

    const ipaVowels = [
        "i",     // [i] - "beet" (cây củ dền)
        "ɪ",     // [ɪ] - "bit" (mảnh)
        "e",     // [e] - "bet" (cá cược)
        "ɛ",     // [ɛ] - "bat" (gậy đánh bóng)
        "æ",     // [æ] - "cat" (mèo)
        "u",     // [u] - "boot" (ủng)
        "ʊ",     // [ʊ] - "put" (đặt)
        "o",     // [o] - "boat" (thuyền)
        "ɔ",     // [ɔ] - "thought" (suy nghĩ)
        "a",     // [a] - "cot" (cũi)
        "ɑ",     // [ɑ] - "father" (cha)
        "ə",     // [ə] - "sofa" (ghế sofa)
        "ɪə",    // [ɪə] - "here" (ở đây)
        "eə",    // [eə] - "pair" (cặp đôi)
        "ʊə",    // [ʊə] - "tour" (chuyến du lịch)
        "ɔɪ",    // [ɔɪ] - "boy" (cậu bé)
        "aɪ",    // [aɪ] - "buy" (mua)
        "aʊ",    // [aʊ] - "how" (như thế nào)
        "eɪ",    // [eɪ] - "say" (nói)
        "oʊ"     // [oʊ] - "go" (đi)
    ];

    const consonantIPAArray = [
        "p", "b", "t", "d", "k", "g", "f", "v", "s", "z", "ʃ", "ʒ", "h", "m", "n", "ŋ", "l", "r", "j", "w"
    ];

    const days = [
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday',
        'Sunday',
    ]

    const months = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December',
    ]

    const seasons = [
        'Spring',
        'Summer',
        'Autumn (or Fall)',
        'Winter',
    ];

    const directions = [
        'North',
        'South',
        'East',
        'West',
        'Northeast',
        'Northwest',
        'Southeast',
        'Due north',
        'Due south',
        'Due east',
        'Up',
        'Down',
        'Left',
        'Right',
        'Forward',
        'Backward',
        'Above',
        'Below',
        'Inside',
        'Outside',
    ]

    const shapes = [
        'Circle',
        'Square',
        'Triangle',
        'Rectangle',
        'Oval',
        'Pentagon',
        'Hexagon',
        'Octagon',
        'Diamond',
        'Heart',
        'Star',
        'Crescent',
    ]

    /**
     * Render View
     */
    return (
        <div className={"container"}>
            <h1>Nhập từ bạn muốn đọc bằng tiếng anh</h1>
            <Textarea onChange={(e) => setText(e.target.value)} placeholder="Type your message here." />
            <Button onClick={() => onClick()}>Speak</Button>

            <h1>Nguyên âm IPA</h1>
            <ul>
                {ipaVowels.map((letter) => (
                    <Button onClick={() => onSpeak(letter)} key={letter}>{letter}</Button>
                ))}
            </ul>

            <h1>Phụ âm IPA</h1>
            <ul>
                {consonantIPAArray.map((letter) => (
                    <Button onClick={() => onSpeak(letter)} key={letter}>{letter}</Button>
                ))}
            </ul>

            <h1>Days</h1>
            <ul>
                {days.map((letter) => (
                    <Button onClick={() => onSpeak(letter)} key={letter}>{letter}</Button>
                ))}
            </ul>

            <h1>Months</h1>
            <ul>
                {months.map((letter) => (
                    <Button onClick={() => onSpeak(letter)} key={letter}>{letter}</Button>
                ))}
            </ul>

            <h1>seasons</h1>
            <ul>
                {seasons.map((letter) => (
                    <Button onClick={() => onSpeak(letter)} key={letter}>{letter}</Button>
                ))}
            </ul>

            <h1>directions</h1>
            <ul>
                {directions.map((letter) => (
                    <Button onClick={() => onSpeak(letter)} key={letter}>{letter}</Button>
                ))}
            </ul>

            <h1>shapes</h1>
            <ul>
                {shapes.map((letter) => (
                    <Button onClick={() => onSpeak(letter)} key={letter}>{letter}</Button>
                ))}
            </ul>

            <h1>Danh sách các ký tự từ 'a' đến 'z'</h1>
            <ul>
                {alphabet.map((letter) => (
                    <Button onClick={() => onSpeak(letter)} key={letter}>{letter}</Button>
                ))}
            </ul>
            <ul>
                {Array.from(Array(101), (e: any, letter: any) =>  (
                    <Button onClick={() => onSpeak(letter)} key={letter}>{letter}</Button>
                ))}
            </ul>

            Trong hệ thống giáo dục tiếng Anh, có nhiều cấp bậc giáo dục khác nhau, từ cấp bậc tiểu học cho đến các cấp bậc đại học và sau đại học. Dưới đây là một số cấp bậc giáo dục phổ biến:

            Preschool (Mẫu giáo): Đây là giai đoạn giáo dục trước tiểu học, dành cho trẻ từ 3 đến 5 tuổi.

            Primary School (Tiểu học): Tiểu học thường bắt đầu từ lớp 1 và kéo dài đến lớp 6 hoặc lớp 7, tùy theo quy định của từng nước.

            Secondary School (Trung học): Trung học thường bắt đầu từ lớp 7 hoặc lớp 8 và kéo dài đến lớp 12 hoặc 13.

            High School (Trường trung học phổ thông): High school thường là từ lớp 9 đến lớp 12 ở Hoa Kỳ. Ở một số quốc gia khác, high school có thể bắt đầu từ lớp 10 hoặc lớp 11.
            College (Trường cao đẳng): College thường là cấp bậc giáo dục sau trung học, và nó có thể kéo dài từ 2 đến 4 năm.

            University (Đại học): Đại học là cấp bậc giáo dục cao cấp, thường kéo dài từ 3 đến 4 năm cho bằng cử nhân (bachelor's degree), và có thể kéo dài thêm cho các bằng cử nhân thứ hai, thạc sĩ và tiến sĩ.

            Graduate School (Trường sau đại học): Graduate school là cấp bậc giáo dục sau đại học, tập trung vào việc nghiên cứu và học sau sâu về một lĩnh vực cụ thể. Điều này bao gồm các chương trình thạc sĩ (master's) và tiến sĩ (doctorate).

            Vocational School (Trường nghề): Vocational school cung cấp đào tạo và học nghề, thường liên quan đến ngành công nghiệp hoặc thương mại cụ thể.

            Community College (Trường cộng đồng): Community college thường cung cấp các khóa học và chương trình đào tạo ngắn hạn hoặc kéo dài từ 2 năm, và nó thường là nơi mọi người có thể bắt đầu học cao đẳng trước khi chuyển tiếp lên đại học.
        </div>
    );
};

export default memo(Alphabet);
