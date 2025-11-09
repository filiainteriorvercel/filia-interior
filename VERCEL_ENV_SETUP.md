# Vercel Environment Variables Setup

## Required Environment Variables

Copy values from your local `.env` file and set them in Vercel Dashboard:
https://vercel.com/fadhlirajwaas-projects/filia-interior/settings/environment-variables

### Database (Aiven) - Copy from local .env lines 30-35
```
AIVEN_DB_HOST=(from .env)
AIVEN_DB_PORT=(from .env)
AIVEN_DB_DATABASE=(from .env)
AIVEN_DB_USERNAME=(from .env)
AIVEN_DB_PASSWORD=(from .env)
```

### Email (Gmail SMTP) - Copy from local .env lines 57-64
```
MAIL_USERNAME=(from .env)
MAIL_PASSWORD=(from .env)
MAIL_FROM_ADDRESS=(from .env)
```

### Application - Copy from local .env line 3
```
APP_KEY=(from .env)
APP_URL=https://filia-interior.vercel.app
```

## How to Add

1. Open your local `.env` file
2. Go to: https://vercel.com/fadhlirajwaas-projects/filia-interior/settings/environment-variables
3. Click "Add New" for each variable
4. Copy the value from your `.env` file
5. Select "All Environments" (Production, Preview, Development)
6. Click "Save"
7. After all variables are added, redeploy your app

## Note

- These values override the dummy values in `.env.vercel` file
- Never commit real credentials to git
- Always use Vercel Dashboard for sensitive data
