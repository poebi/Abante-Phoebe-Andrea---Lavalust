const API_ROOT = (import.meta.env.VITE_API_URL || 'http://localhost/LavaLust/api').replace(/\/+$/, '');
const ACCESS_KEY = 'lavalust_access_token';
const REFRESH_KEY = 'lavalust_refresh_token';

export const authStorage = {
  get access() { return localStorage.getItem(ACCESS_KEY); },
  get refresh() { return localStorage.getItem(REFRESH_KEY); },
  save(tokens) {
    localStorage.setItem(ACCESS_KEY, tokens.access_token);
    if (tokens.refresh_token) localStorage.setItem(REFRESH_KEY, tokens.refresh_token);
  },
  clear() {
    localStorage.removeItem(ACCESS_KEY);
    localStorage.removeItem(REFRESH_KEY);
  },
};

export async function apiRequest(path, { method = 'GET', body, auth = true } = {}) {
  const headers = { Accept: 'application/json' };
  if (body !== undefined) headers['Content-Type'] = 'application/json';
  if (auth && authStorage.access) headers.Authorization = `Bearer ${authStorage.access}`;

  const response = await fetch(`${API_ROOT}${path}`, {
    method,
    headers,
    ...(body !== undefined ? { body: JSON.stringify(body) } : {}),
  });
  const payload = response.status === 204 ? null : await response.json().catch(() => null);

  if (!response.ok) {
    if (response.status === 401 && auth) authStorage.clear();
    throw new Error(payload?.error || payload?.message || `Request failed (${response.status})`);
  }
  return payload;
}

export const productApi = {
  list: () => apiRequest('/products'),
  create: (product) => apiRequest('/products', { method: 'POST', body: product }),
  update: (id, product) => apiRequest(`/products/${encodeURIComponent(id)}`, { method: 'PUT', body: product }),
  remove: (id) => apiRequest(`/products/${encodeURIComponent(id)}`, { method: 'DELETE' }),
};

export async function login(username, password) {
  const result = await apiRequest('/auth/login', {
    method: 'POST', body: { username, password }, auth: false,
  });
  const tokens = result?.data?.tokens;
  if (!tokens?.access_token) throw new Error('The API did not return an access token.');
  authStorage.save(tokens);
  return result.data.user;
}
