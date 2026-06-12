FROM python:3.9-slim
WORKDIR /app

ENV DB_HOST="localhost"
ENV DB_PORT="5432"
ENV DB_USER="postgres"
ENV DB_PASSWORD="secret_password"

COPY api/requirements.txt .
RUN pip install --no-cache-dir -r requirements.txt

COPY api/app/ .

CMD ["uvicorn", "main:app", "--host", "0.0.0.0", "--port", "8000"]