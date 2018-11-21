export const Configure = {
  basePort : '8000',
  baseUrl : 'http://localhost',
  requestInterval: 10000,
  url: () => {
    return `${Configure.baseUrl}:${Configure.basePort}`;
  },
  api: () => {
    return `${Configure.baseUrl}:${Configure.basePort}/api`;
  }
};
