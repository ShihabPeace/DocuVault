// TypeScript types for your local ziggy.js object
export interface ZiggyConfig {
    url: string;
    port: number | null;
    defaults: object;
    routes: Record<string, any>;
}

declare const Ziggy: ZiggyConfig;
export default Ziggy;
