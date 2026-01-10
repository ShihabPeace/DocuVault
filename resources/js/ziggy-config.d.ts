import type { Config } from 'ziggy-js';

// Tell TypeScript that './ziggy' exports a default object of type Config
declare module './ziggy' {
  const Ziggy: Config;
  export default Ziggy;
}
