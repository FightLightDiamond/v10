import {Tilt} from "../Tilt";
import {motion} from "framer-motion";
import {IMatchLog} from "@/App/interfaces/match-log.interface";
import {Progress} from "@/shadcn/ui/progress";
import {Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle} from "@/shadcn/ui/card";

const skills: any = {
    Chiron: "+Atk = 80% máu bị mất. Ví dụ máu giảm 50% tăng 40% ATK, giảm về 90% tăng 72% dame",
    Hell: "1. Kết liễu đối thủ nếu HP <= 30%. 2. HP < 70% và máu ít hơn đối thủ, +ATK 10% = hp đối phương - hp bản thân",
    Valkyrie: "mỗi turn đốt 2% máu cộng dồn tối đa 5 lần",
    Hera: "1. -20% ATK đối phương khi kích hoạt nội tại. 2. 30% cấm nội tại đối phương, ngược lại 70% +15% crit dmg",
    Darklord: "HP <= 65% HP, +60% ATK và +50% def",
    Poseidon: "ATK +7% tối đa 10 lần, tăng 2% def",
    Phoenix: "if hp <= 60%,  hồi lại 40% HP bị mất, x2 def, +20% tỉ lệ crit",
    Fenrir: "+5% crit rate, +15% crit_dame mỗi lượt",
    Sphinx: "-(20 + 20% def) đối thủ mỗi lượt. Mỗi turn chẵn nếu HP < HP đối phương, +10% crit rate, ATK",
    Amon: "+HP = 30% atk, +DEF 5%, +CRIT DMG 10% mỗi turn",
}

function viewCurrent(c: number | undefined) {
    if (c === undefined) return 0;
    return c > 0 ? c : 0;
}

const HeroTurn = ({hero}: { hero: IMatchLog }) => {
    const containerStyle = {
        // padding: "20px",
        // margin: "20px",
    };
    return <Card>
        <CardHeader>
            <CardTitle>{hero.name}</CardTitle>
            <CardDescription>HP: {hero.current_hp}, ATK: {hero.atk}, DEF: {hero.def},
                CRIT RATE: {hero.current_crit_rate}, CRIT DMG: {hero.current_crit_dmg}</CardDescription>
        </CardHeader>
        <CardContent>
            <motion.h3 style={containerStyle}
                animate={{
                    opacity: hero.take_dmg ? 1 : 0,
                }}
                transition={{
                    duration: 3,
                    delay: 1,
                }}
                className="text-warning text-center">{hero.take_skill_dmg ? "-" + hero.take_skill_dmg : ''}&nbsp;</motion.h3>
            <motion.h3 style={containerStyle}
                animate={{
                    opacity: hero.take_dmg ? 1 : 0,
                }}
                transition={{
                    type: "spring",
                    bounce: 10,
                    delay: 1.1,
                    duration: 3,
                }}
                className="text-danger text-center">{hero.take_dmg ? "-" + hero.take_dmg : ''}&nbsp;</motion.h3>
            <motion.div style={containerStyle}
                key={hero.name}
                animate={{
                    scale: !hero.take_dmg ? [0.5, 0.7] : 0.7,
                    opacity: !hero.take_dmg ? [0.5, 1] : 1,
                }}
                transition={{
                    duration: 1,
                }}
                exit={{
                    scale: 1,
                }}
            >
                <img
                    src={`/img/heroes/${hero?.name}.png`}
                    alt="of the author"
                    // className="w-full h-full  object-cover"
                />
            </motion.div>
        </CardContent>
        <CardFooter>
            <p className="text-light text-center">{skills[hero.name]}</p>
        </CardFooter>
    </Card>
}

export default HeroTurn
