import {memo, useEffect, useState} from "react";
import axios from "axios";
import {Button} from "@/shadcn/ui/button";
import {Textarea} from "@/shadcn/ui/textarea";

const Alphabet = () => {
    const [text, setText] = useState('');

    /**
     * Method
     * @param text
     */
    const onSpeak = (text) => {
        const audio = new Audio('http://localhost:8000/speaks?text=' + text);
        audio.play();
    }

    const onClick = () => {
        onSpeak(text)
    }

    const alphabet = Array.from({ length: 26 }, (_, index) => String.fromCharCode(97 + index));

    /**
     * Render View
     */
    return (
        <div className={"container"}>
            <h1>Nhập từ bạn muốn đọc bằng tiếng anh</h1>
            <Textarea onChange={(e) => setText(e.target.value)} placeholder="Type your message here." />
            <Button onClick={() => onClick()}>Speak</Button>

            <h1>Danh sách các ký tự từ 'a' đến 'z'</h1>
            <ul>
                {alphabet.map((letter) => (
                    <Button onClick={() => onSpeak(letter)} key={letter}>{letter}</Button>
                ))}
            </ul>
            <ul>
                {Array.from(Array(101), (e, letter) =>  (
                    <Button onClick={() => onSpeak(letter)} key={letter}>{letter}</Button>
                ))}
            </ul>
        </div>
    );
};

export default memo(Alphabet);
