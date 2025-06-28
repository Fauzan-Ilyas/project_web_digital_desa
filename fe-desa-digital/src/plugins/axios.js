import axios from "axios";

// Simple cookie utility (no external dependencies)
const cookies = {
    get: (name) => {
        if (typeof document === 'undefined') return null;
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) {
            return parts.pop().split(';').shift();
        }
        return null;
    },
    
    set: (name, value, days = 7) => {
        if (typeof document === 'undefined') return;
        const expires = new Date();
        expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
        document.cookie = `${name}=${value};expires=${expires.toUTCString()};path=/`;
    },
    
    remove: (name) => {
        if (typeof document === 'undefined') return;
        document.cookie = `${name}=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/`;
    }
};

// Axios configuration
axios.defaults.baseURL = "http://localhost:8000/api";
axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
axios.defaults.headers.common["Accept"] = "application/json";


// Request interceptor
axios.interceptors.request.use(
    config => {
        // Get fresh token on every request
        const token = cookies.get("token");
        
        if (token) {
            config.headers.Authorization = `Bearer ${token}`;
        }

        // Handle Content-Type properly
        if (config.data instanceof FormData) {
            // For file uploads, remove Content-Type to let browser set it with boundary
            delete config.headers["Content-Type"];
        } else if (!config.headers["Content-Type"]) {
            // Default to JSON for regular requests
            config.headers["Content-Type"] = "application/json";
        }

        return config;
    },
    error => {
        return Promise.reject(error);
    }
);

// Response interceptor for error handling
axios.interceptors.response.use(
    response => response,
    error => {
        if (error.response?.status === 401) {
            // Unauthorized - remove token and redirect
            cookies.remove("token");
            if (typeof window !== "undefined") {
                window.location.href = "/login";
            }
        }
        return Promise.reject(error);
    }
);

export const axiosInstance = axios;