FROM php:8.2-apache

COPY . /usr/src/app
WORKDIR /usr/src/app

RUN pip install --upgrade pip
RUN pip install -r requirements.txt
ENTRYPOINT python -m uvicorn --host 0.0.0.0 api:app --reload