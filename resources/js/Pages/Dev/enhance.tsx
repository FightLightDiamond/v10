import {useState} from "react";
import {Button} from "@/shadcn/ui/button";
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from "@/shadcn/ui/card"

const Enhance = () => {
    const dmgVK = 1331;
    const [level, setLevel] = useState(1)
    const [dmg, setDmg] = useState(dmgVK)// 1100, 1210, 1331, -<//1464 -<//1771 // 2143

    const [items, setItems] = useState<any>({
        sun: 0,
        som: 0,
        sox: 0,
        luckyStore: 0,
        sLuckyStore: 0,
        upStore: 0,
        sUpStore: 0,
        protectStore: 0,
        gold: 2000,
    })

    const gachaConfig = {
        sun: { no: 2, value: 1},
        som: { no: 10, value: 1},
        sos: { no: 100, value: 1},
        sUpStore: { no: 200, value: 1},
        sLuckyStore: { no: 300, value: 1},
        protectStore: { no: 500, value: 1},
        gold: { no: 1000, value: 1000},
        luckyStore: { no: 4000, value: 1},
        upStore: { no: 10001, value: 1},
    }

    const onSuccess = () => {
        const newLevel = level + 1;
        setLevel(newLevel)
        setDmg(parseInt(String(1.1 ** level * dmgVK)))
    }

    const onFail = () => {
        if (items.protectStore > 0) {
            const newLevel = level - 1;
            if (level > 1) {
                setLevel(newLevel)
            }

            setDmg(parseInt(String(1.1 ** (newLevel - 1) * dmgVK)))
        } else {
            setLevel(1)
            setDmg(dmgVK)
        }
    }

    const onRate = (n = 1000) => {
        return parseInt(String(0.9 ** level * n))
    }

    const onRateNex = () => {
        let rateExtra = 0;
        if (items.luckyStore) {
            rateExtra = 50
        }
        return parseInt(String(((0.9 ** (level) * 1000) + rateExtra) / 10))
    }

    const onRandom = (n = 1000) => {
        return Math.floor(Math.random() * n) + 1;
    }

    const onByProtectStore = () => {
        if (items.gold < 50) {
            alert('Không đủ tiền')
            return;
        }

        setItems({...items, gold: items.gold - 50, protectStore: items.protectStore + 1})
    }

    const onByStoreLucky = () => {
        if (items.gold < 50) {
            alert('Không đủ tiền')
            return;
        }

        setItems({...items, gold: items.gold - 50, luckyStore: items.luckyStore + 1})
    }

    const onEnhance = () => {
        if (items.upStore < 1) {
            alert('Không đá nâng cấp')
            return;
        }

        const numberRandom = onRandom();
        let numberRate = onRate();

        let protectStore = 0
        if (items.protectStore > 0) {
            protectStore = 1
        }

        let luckyStore = 0
        if (items.luckyStore > 0) {
            luckyStore = 1
        }


        if (luckyStore) {
            numberRate += 50
        }

        setItems({...items,
            // gold: items.gold - 50,
            upStore: items.upStore - 1,
            luckyStore: items.luckyStore - luckyStore,
            protectStore: items.protectStore - protectStore,
        })

        if (numberRandom <= numberRate) {
            onSuccess()
        } else {
            onFail()
        }
    }

    const setItem = (key, no) => {
        items[key] += no;
        items.gold -= 60;
        setItems({...items})
    }

    const gacha = number => {
        //10.000
        if (number < 2) {
            setItem('sun', 1)
            return;
        }
        if (number < 10) {
            setItem('som', 1)
            return;
        }
        if (number < 100) {
            setItem('sos', 1)
            return;
        }
        if (number < 200) {
            setItem('sUpStore', 1)
            return;
        }
        if (number < 400) {
            setItem('sLuckyStore', 1)
            return;
        }
        if (number < 600) {
            setItem('gold', 1000)
            return;
        }
        if (number < 2000) {
            setItem('protectStore', 1)
            return;
        }
        if (number < 4000) {
            setItem('luckyStore', 1)
            return;
        }

        setItem('upStore', 1)
    }

    const onGacha = () => {
        if(items.gold < 60) {
            alert('Khong du tien')
            return;
        }
        const no = onRandom(10000)
        gacha(no)
    }

    return (
        <div>
            <Card>
                <CardHeader>
                    <CardTitle>Nâng cấp vũ khí</CardTitle>
                    <CardDescription>Cấp: +{level}</CardDescription>
                    <p>Sức mạnh: {dmg}</p>
                    <p>Tiền: {items.gold}</p>
                    <p>Đá bảo vệ: {items.protectStore}</p>
                    <p>Đá may mắn: {items.luckyStore}</p>
                    <p>Tỉ lệ thành công: {onRateNex()}%</p>
                    <p>{JSON.stringify(items)}</p>
                </CardHeader>
                <CardContent>
                    <img
                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTozAHN-Dfah6Ip5IKtzx_lp5VnHHfL44FFfw&usqp=CAU"
                        alt=""/>
                </CardContent>
                <CardFooter>
                    <Button onClick={onEnhance}>Up</Button>
                    <Button onClick={onByProtectStore}>Mua đá bảo vệ</Button>
                    <Button onClick={onByStoreLucky}>Mua đá may mắn</Button>
                    <Button onClick={onGacha}>Gacha</Button>
                </CardFooter>
            </Card>

        </div>
    )
}

export default Enhance
