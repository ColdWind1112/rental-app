FROM node:13

WORKDIR /app

# COPY package*.json /app/
COPY . /app/

RUN npm install

EXPOSE 80

CMD npm run serve
