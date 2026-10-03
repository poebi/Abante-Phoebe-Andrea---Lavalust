# LavaLust Stockroom

React + Vite frontend for the LavaLust products API.

## Run locally

1. Copy `.env.example` to `.env` and set `VITE_API_URL` to your backend API root (the URL ending in `/api`).
2. From this directory run `npm install`, then `npm run dev`.
3. Set the backend `CORS_ALLOWED_ORIGINS` to include the Vite origin, usually `http://localhost:5173`.

For Render, set `VITE_API_URL` to the deployed backend API root, such as `https://your-backend.onrender.com/api`, before building.

The login screen expects the backend's `POST /auth/login` response with `data.tokens.access_token` and `data.tokens.refresh_token`. Product calls use `/products` and send the access token as a Bearer token.
