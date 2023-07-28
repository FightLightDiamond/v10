import { AxiosInstance } from 'axios';
import ziggyRoute, { Config as ZiggyConfig } from 'ziggy-js';

declare global {
    interface Window {
        axios: AxiosInstance;
        io: any; // Thay any bằng kiểu dữ liệu của Echo nếu bạn biết trước kiểu dữ liệu chính xác.
        Echo: any; // Thay any bằng kiểu dữ liệu của Echo nếu bạn biết trước kiểu dữ liệu chính xác.
    }

    var route: typeof ziggyRoute;
    var Ziggy: ZiggyConfig;
}
