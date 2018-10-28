export const Configure = {
  basePort : '8000',
  baseUrl : 'http://localhost',
  url: () => {
    return `${Configure.baseUrl}:${Configure.basePort}`;
  },
  api: () => {
    return `${Configure.baseUrl}:${Configure.basePort}/api`;
  }
};
