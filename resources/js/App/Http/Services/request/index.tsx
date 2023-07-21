import axios from "axios";
import Cookies from "js-cookie"

const apiEndpoint = '/';

class Request {
	instance;
	constructor() {
		const instance = axios.create({
			baseURL: apiEndpoint,
			headers: {
				"Content-Type": "application/json",
				Accept: "application/json",
			},
			validateStatus: (status: number) => {
				return status >=200 && status < 400
			}
		});

		instance.interceptors.request.use(
			async (config: any) => {
				const token = Cookies.get("token");
				if (token) {
					config.headers["Authorization"] = `Bearer ${token}`;
				}

				return config;
			},
			(error: any) => {
				Promise.reject(error).then(r => console.log(r));
			}
		);

		this.instance = instance;
	}

	get = (url: string, params?: object) => {
		return this.instance.get(apiEndpoint + url, { params });
	};

	post = (url: string, data?: object, headers?: any) => {
		return this.instance.post(apiEndpoint + url, data);
	};

	put = (url: string, data?: object) => {
		return this.instance.put(apiEndpoint + url, data);
	};

	patch = (url: string, data: object) => {
		return this.instance.patch(apiEndpoint + url, data);
	};

	delete = (url: string) => {
		return this.instance.delete(apiEndpoint + url);
	};
}

export default new Request();
