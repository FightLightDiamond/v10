// @ts-ignore
import {io} from "socket.io-client";
import Cookies from "js-cookie";
import Echo from "laravel-echo";

const wsEndpoint = '/';

/**
 * class WS
 */
export class WS {
    private static client: any = null
    private static status: number = 0
    private static token: string = Cookies.get('token') ?? ''

    static async w4(time = 50) {
        await setTimeout(() => {}, time)
    }

    /**
     * Get Socket
     */
    static async getSocket() {
        if (this.status) {
            await this.w4()
            await this.getSocket()
        }

        if (this.client !== null) {
            return this.client;
        }

        this.status = 1

        // this.client = await io(wsEndpoint, {
        //     reconnection: true,
        //     reconnectionDelay: 500,
        //     extraHeaders: {
        //         Authorization: `${this.token}`
        //     },
        // });

        this.client = new Echo({
            broadcaster: 'redis',
            // key: import.meta.env.VITE_PUSHER_APP_KEY,
            // cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
            // wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
            // wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
            // wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
            // forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
            // enabledTransports: ['ws', 'wss'],
        });

        this.status = 0;

        return this.client
    }

    /**
     * Reconnect socket
     * @param token
     */
    static async reconnectSocket(token: string) {
        this.token = token
        this.client = await io(wsEndpoint, {
            reconnection: true,
            reconnectionDelay: 500,
            extraHeaders: {
                Authorization: `${this.token}`
            },
        });
    }
}
