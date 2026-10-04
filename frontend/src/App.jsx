import { createContext, useContext, useEffect, useMemo, useState } from 'react';
import { Link, Navigate, Route, Routes, useLocation, useNavigate } from 'react-router-dom';
import { authStorage, login, productApi } from './api.js';

const AuthContext = createContext(null);
const useAuth = () => useContext(AuthContext);

function App() {
  const [token, setToken] = useState(authStorage.access);
  const [user, setUser] = useState(() => {
    try { return JSON.parse(localStorage.getItem('lavalust_user') || 'null'); } catch { return null; }
  });
  const auth = useMemo(() => ({
    token,
    user,
    async signIn(username, password) {
      const profile = await login(username, password);
      localStorage.setItem('lavalust_user', JSON.stringify(profile));
      setUser(profile);
      setToken(authStorage.access);
    },
    signOut() {
      authStorage.clear();
      localStorage.removeItem('lavalust_user');
      setUser(null);
      setToken(null);
    },
  }), [token, user]);

  useEffect(() => {
    const onStorage = () => setToken(authStorage.access);
    window.addEventListener('storage', onStorage);
    return () => window.removeEventListener('storage', onStorage);
  }, []);

  return <AuthContext.Provider value={auth}>
    <Routes>
      <Route path="/login" element={token ? <Navigate to="/" replace /> : <LoginPage />} />
      <Route path="/" element={token ? <Dashboard /> : <Navigate to="/login" replace />} />
      <Route path="*" element={<Navigate to={token ? '/' : '/login'} replace />} />
    </Routes>
  </AuthContext.Provider>;
}

function Brand({ compact = false }) {
  return <div className={`brand ${compact ? 'brand-compact' : ''}`}>
    <span className="brand-mark">FV</span>
    {!compact && <span className="brand-name">Fragrance<span>Vault</span></span>}
  </div>;
}

function LoginPage() {
  const { signIn } = useAuth();
  const navigate = useNavigate();
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState('');
  const [busy, setBusy] = useState(false);

  async function handleSubmit(event) {
    event.preventDefault();
    setError('');
    setBusy(true);
    try {
      await signIn(username.trim(), password);
      navigate('/', { replace: true });
    } catch (err) {
      setError(err.message || 'Unable to sign in. Check your connection and try again.');
    } finally { setBusy(false); }
  }

  return <main className="login-shell">
    <div className="login-decoration decor-one" /><div className="login-decoration decor-two" />
    <section className="login-card">
      <Brand />
      <div className="login-heading">
        <span className="eyebrow">ANOTHER DAY, ANOTHER SPRAY</span>
        <h1>Welcome<br />back<span>.</span></h1>
        <p>A fragrance collection: somewhere between a passionate hobby and organized hoarding.</p>
      </div>
      <form onSubmit={handleSubmit} className="login-form">
        <label htmlFor="username">Username</label>
        <input id="username" autoComplete="username" value={username} onChange={e => setUsername(e.target.value)} placeholder="Enter your username" required />
        <div className="password-label"><label htmlFor="password">Password</label><span>Secure access</span></div>
        <input id="password" type="password" autoComplete="current-password" value={password} onChange={e => setPassword(e.target.value)} placeholder="Enter your password" required />
        {error && <div className="form-error" role="alert">{error}</div>}
        <button className="button button-primary button-wide" type="submit" disabled={busy}>{busy ? 'Signing in…' : 'Sign in'}</button>
      </form>
      <p className="login-foot">System Login</p>
    </section>
    <aside className="login-quote"><div className="quote-orbit">✳</div><p>Leave behind<br /><em>an unforgettable trace.</em></p><span>Where bottles become stories and scents become memories.</span></aside>
  </main>;
}

function Dashboard() {
  const { user, signOut } = useAuth();
  const navigate = useNavigate();
  const [products, setProducts] = useState([]);
  const [loading, setLoading] = useState(true);
  const [loadError, setLoadError] = useState('');
  const [search, setSearch] = useState('');
  const [modalProduct, setModalProduct] = useState(undefined);
  const [notice, setNotice] = useState('');
  const [isDark, setIsDark] = useState(() => localStorage.getItem('theme') === 'dark');

  async function loadProducts() {
    setLoading(true);
    setLoadError('');
    try {
      const result = await productApi.list();
      setProducts(Array.isArray(result?.data) ? result.data : []);
    } catch (err) {
      setLoadError(err.message);
      if (!authStorage.access) { signOut(); navigate('/login', { replace: true }); }
    } finally { setLoading(false); }
  }

  useEffect(() => { loadProducts(); }, []);

  async function handleDelete(product) {
    if (!window.confirm(`Delete “${product.product_name}”? This action cannot be undone.`)) return;
    try {
      await productApi.remove(product.id);
      setProducts(current => current.filter(item => String(item.id) !== String(product.id)));
      setNotice('Product deleted');
    } catch (err) { setNotice(err.message); }
  }

  function handleSaved(message, product) {
    setProducts(current => {
      const exists = current.some(item => String(item.id) === String(product.id));
      return exists ? current.map(item => String(item.id) === String(product.id) ? product : item) : [product, ...current];
    });
    setModalProduct(undefined);
    setNotice(message);
  }

  useEffect(() => {
    if (!notice) return undefined;
    const timer = window.setTimeout(() => setNotice(''), 3200);
    return () => window.clearTimeout(timer);
  }, [notice]);

  useEffect(() => {
    if (isDark) {
      document.body.classList.add('dark-mode');
      localStorage.setItem('theme', 'dark');
    } else {
      document.body.classList.remove('dark-mode');
      localStorage.setItem('theme', 'light');
    }
  }, [isDark]);

  const visibleProducts = products.filter(product => `${product.product_name} ${product.description || ''}`.toLowerCase().includes(search.toLowerCase()));
  const totalValue = products.reduce((sum, product) => sum + Number(product.price || 0) * Number(product.quantity || 0), 0);
  const lowStock = products.filter(product => Number(product.quantity) <= 5).length;
  const formatter = new Intl.NumberFormat(undefined, { style: 'currency', currency: 'PHP' });
  const initials = (user?.username || 'U').slice(0, 1).toUpperCase();

  return <div className="app-shell">
    <aside className="sidebar">
      <Link className="sidebar-brand" to="/"><Brand /></Link>
      <div className="sidebar-section-label">WORKSPACE</div>
      <nav className="side-nav"><a href="#inventory" className="side-link active"><span className="nav-icon">▦</span> Products <span className="nav-count">{products.length}</span></a></nav>
      <div className="sidebar-bottom"><div className="sidebar-tip"><span className="tip-icon">✳</span><strong>Little things add up.</strong><p>Keep your scents cataloged and your team completely aligned.</p></div><div className="sidebar-version" style={{textAlign: 'center'}}></div></div>
    </aside>

    <main className="main-panel">
      <header className="topbar"><div className="mobile-brand"><Brand compact /></div><div className="breadcrumb">Workspace <span>/</span> <strong>Products</strong></div><div className="topbar-right"><button className="icon-button" onClick={() => setIsDark(!isDark)} style={{border: 'none', background: 'transparent', fontSize: '18px'}}>{isDark ? '☀️' : '🌙'}</button><div className="topbar-divider" /><div className="user-avatar">{initials}</div><div className="user-detail"><strong>{user?.username || 'Account'}</strong><span>Workspace member</span></div><button className="icon-button logout-button" onClick={() => { signOut(); navigate('/login', { replace: true }); }} title="Sign out" aria-label="Sign out">↗</button></div></header>

      <div className="page-content" id="inventory">
        <div className="page-heading"><div><span className="eyebrow">INVENTORY OVERVIEW</span><h1>Products<span>.</span></h1><p></p></div><button className="button button-primary" onClick={() => setModalProduct(null)}><span className="plus">+</span> Add product</button></div>

        <section className="stats-grid" aria-label="Inventory summary">
          <StatCard label="Total" value={products.length.toLocaleString()} note="" icon="▦" tone="mint" />
          <StatCard label="Value" value={formatter.format(totalValue)} note="" icon="₱" tone="lavender" />
          <StatCard label="Low stock" value={lowStock.toLocaleString()} note="5 units or fewer" icon="⌁" tone="peach" />
        </section>

        <section className="inventory-panel">
          <div className="panel-heading"><div><h2>List of products</h2><p></p></div><div className="catalog-tools"><label className="search-box"><span>⌕</span><input aria-label="Search products" value={search} onChange={e => setSearch(e.target.value)} placeholder="Search products..." /><kbd>⌘ K</kbd></label><button className="button button-outline add-mobile" onClick={() => setModalProduct(null)}><span className="plus">+</span> Add product</button></div></div>
          {loadError && <div className="load-error" role="alert"><span>{loadError}</span><button className="button button-outline" onClick={loadProducts}>Try again</button></div>}
          {loading ? <div className="empty-state"><span className="loading-spinner" /><p>Loading your products…</p></div> : visibleProducts.length === 0 ? <div className="empty-state"><div className="empty-icon">▦</div><h3>{search ? 'No matching products' : 'Your catalog is ready'}</h3><p>{search ? 'Try another search term.' : 'Add your first product and it will show up here.'}</p>{!search && <button className="button button-primary" onClick={() => setModalProduct(null)}>Add your first product</button>}</div> : <>
            <div className="table-wrap"><table><thead><tr><th>PRODUCT</th><th>PRICE</th><th>QUANTITY</th><th>STOCK STATUS</th><th><span className="sr-only">Actions</span></th></tr></thead><tbody>{visibleProducts.map((product, index) => <ProductRow key={product.id} product={product} index={index} formatter={formatter} onEdit={() => setModalProduct(product)} onDelete={() => handleDelete(product)} />)}</tbody></table></div>
            <div className="mobile-product-grid">{visibleProducts.map((product, index) => <ProductCard key={product.id} product={product} index={index} formatter={formatter} onEdit={() => setModalProduct(product)} onDelete={() => handleDelete(product)} />)}</div>
            <div className="table-footer"><span>Showing <strong>{visibleProducts.length}</strong> of <strong>{products.length}</strong> products</span><span className="updated-label"><span className="status-dot" /> Up to date</span></div>
          </>}
        </section>
        <footer className="page-footer"><span>Inventory Management</span><span>Admin <b>·</b> Portal</span></footer>
      </div>
    </main>

    {modalProduct !== undefined && <ProductModal product={modalProduct} onClose={() => setModalProduct(undefined)} onSaved={handleSaved} />}
    {notice && <div className="toast" role="status"><span>✓</span>{notice}</div>}
  </div>;
}

function StatCard({ label, value, note, icon, tone }) {
  return <article className="stat-card"><div className={`stat-icon ${tone}`}>{icon}</div><div className="stat-copy"><span>{label}</span><strong>{value}</strong><small>{note}</small></div><span className="stat-arrow">↗</span></article>;
}

const swatches = ['#d5e8dc', '#e8ddf1', '#f2e1d4', '#dce5f1', '#efe7c9'];
function ProductMark({ product, index }) {
  const initials = (product.product_name || '?').trim().split(/\s+/).slice(0, 2).map(part => part[0]).join('').toUpperCase();
  return <span className="product-mark" style={{ backgroundColor: swatches[index % swatches.length] }}>{initials}</span>;
}

function StockPill({ quantity }) {
  const low = Number(quantity) <= 5;
  return <span className={`stock-pill ${low ? 'stock-low' : 'stock-healthy'}`}><i />{low ? 'Low stock' : 'In stock'}</span>;
}

function ProductRow({ product, index, formatter, onEdit, onDelete }) {
  return <tr><td><div className="product-cell"><ProductMark product={product} index={index} /><div className="product-cell-copy"><strong>{product.product_name}</strong><span>{product.description || 'No description'}</span></div></div></td><td className="price-cell">{formatter.format(Number(product.price || 0))}</td><td><span className="quantity-value">{product.quantity}</span><span className="units-label"> units</span></td><td><StockPill quantity={product.quantity} /></td><td><div className="row-actions"><button className="row-action" onClick={onEdit} aria-label={`Edit ${product.product_name}`} title="Edit">↗</button><button className="row-action delete-action" onClick={onDelete} aria-label={`Delete ${product.product_name}`} title="Delete">×</button></div></td></tr>;
}

function ProductCard({ product, index, formatter, onEdit, onDelete }) {
  return <article className="product-card"><div className="product-card-top"><div className="product-cell"><ProductMark product={product} index={index} /><div className="product-cell-copy"><strong>{product.product_name}</strong><span>{product.description || 'No description'}</span></div></div><div className="row-actions"><button className="row-action" onClick={onEdit} aria-label={`Edit ${product.product_name}`}>↗</button><button className="row-action delete-action" onClick={onDelete} aria-label={`Delete ${product.product_name}`}>×</button></div></div><div className="product-card-bottom"><div><small>PRICE</small><strong>{formatter.format(Number(product.price || 0))}</strong></div><div><small>QUANTITY</small><strong>{product.quantity} units</strong></div><StockPill quantity={product.quantity} /></div></article>;
}

function ProductModal({ product, onClose, onSaved }) {
  const editing = Boolean(product);
  const [values, setValues] = useState({ product_name: product?.product_name || '', description: product?.description || '', price: product?.price ?? '', quantity: product?.quantity ?? '' });
  const [error, setError] = useState('');
  const [busy, setBusy] = useState(false);

  useEffect(() => {
    const onKey = event => { if (event.key === 'Escape' && !busy) onClose(); };
    window.addEventListener('keydown', onKey);
    return () => window.removeEventListener('keydown', onKey);
  }, [busy, onClose]);

  async function submit(event) {
    event.preventDefault();
    const price = Number(values.price);
    const quantity = Number(values.quantity);
    if (!values.product_name.trim()) return setError('Enter a product name.');
    if (!Number.isFinite(price) || price < 0 || !/^\d{1,8}(\.\d{1,2})?$/.test(values.price)) return setError('Enter a price with up to 2 decimal places.');
    if (!Number.isInteger(quantity) || quantity < 0) return setError('Quantity must be a whole number of 0 or more.');
    setError(''); setBusy(true);
    const body = { product_name: values.product_name.trim(), description: values.description.trim(), price: values.price, quantity };
    try {
      const result = editing ? await productApi.update(product.id, body) : await productApi.create(body);
      const saved = result?.data;
      if (!saved?.id) throw new Error('The API did not return the saved product.');
      onSaved(editing ? 'Product updated' : 'Product added', saved);
    } catch (err) { setError(err.message || 'Could not save this product.'); }
    finally { setBusy(false); }
  }

  return <div className="modal-backdrop" onMouseDown={event => { if (event.target === event.currentTarget && !busy) onClose(); }}>
    <section className="product-modal" role="dialog" aria-modal="true" aria-labelledby="modal-title">
      <div className="modal-topline"><span className="eyebrow">PRODUCT DETAILS</span><button className="modal-close" onClick={onClose} aria-label="Close dialog">×</button></div>
      <h2 id="modal-title">{editing ? 'Edit product' : 'Add a product'}<span>.</span></h2><p className="modal-intro">{editing ? 'Update the details for this product.' : 'Add something new to your product catalog.'}</p>
      <form onSubmit={submit} className="product-form">
        <label htmlFor="product_name">Product name <span>*</span></label><input id="product_name" maxLength="100" required autoFocus value={values.product_name} onChange={e => setValues({ ...values, product_name: e.target.value })} placeholder="e.g. Ceramic coffee cup" />
        <label htmlFor="description">Description</label><textarea id="description" rows="3" value={values.description} onChange={e => setValues({ ...values, description: e.target.value })} placeholder="A short description of your product" />
        <div className="form-columns"><div><label htmlFor="price">Price <span>*</span></label><div className="input-prefix"><span>₱</span><input id="price" type="number" min="0" step="0.01" max="99999999.99" required value={values.price} onChange={e => setValues({ ...values, price: e.target.value })} placeholder="0.00" /></div></div><div><label htmlFor="quantity">Quantity <span>*</span></label><input id="quantity" type="number" min="0" step="1" required value={values.quantity} onChange={e => setValues({ ...values, quantity: e.target.value })} placeholder="0" /></div></div>
        {error && <div className="form-error" role="alert">{error}</div>}
        <div className="modal-actions"><button className="button button-outline" type="button" disabled={busy} onClick={onClose}>Cancel</button><button className="button button-primary" type="submit" disabled={busy}>{busy ? 'Saving…' : editing ? 'Save changes' : 'Add product'} <span aria-hidden="true">↗</span></button></div>
      </form>
    </section>
  </div>;
}

export default App;
