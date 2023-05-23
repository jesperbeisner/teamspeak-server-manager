# [WIP] teamspeak-server-manager

## Local

### 1. Create network

```bash
docker network create teamspeak
```

### 2. Run teamspeak-server

```bash
docker run -p 9987:9987/udp -p 10080:10080 --network teamspeak -e TS3SERVER_LICENSE=accept -e TS3SERVER_QUERY_PROTOCOLS=http --name teamspeak-server teamspeak:3.13
```

### 3. Look up teamspeak network subnet

```bash
docker network inspect teamspeak
```

### 4. Add subnet to teamspeak-server allowlist

```bash
docker exec -it teamspeak-server sh -c "echo 172.27.0.0/16 >> query_ip_allowlist.txt"
```

### 5. Run teamspeak-server-manager

```bash
docker compose up
```

## Production

### 1. Create network

```bash
docker network create teamspeak
```

### 2. Run teamspeak-server

```bash
docker run -d -p 9987:9987/udp --network teamspeak -e TS3SERVER_LICENSE=accept -e TS3SERVER_QUERY_PROTOCOLS=http --name teamspeak-server teamspeak:3.13
```

### 3. Look up teamspeak network subnet

```bash
docker network inspect teamspeak
```

### 4. Add subnet to teamspeak-server allowlist

```bash
docker exec -it teamspeak-server sh -c "echo 172.27.0.0/16 >> query_ip_allowlist.txt"
```

### 5. Run teamspeak-server-manager

```bash
docker run -d -p PORT:9501 --network teamspeak -e TEAMSPEAK_API_KEY=PLACEHOLDER --name teamspeak-server-manager ghcr.io/jesperbeisner/teamspeak-server-manager:X.X.X
```

## Build

```bash
docker build -f .docker/prod/Dockerfile -t teamspeak-server-manager .
```
