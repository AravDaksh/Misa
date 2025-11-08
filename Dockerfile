FROM php:8.2-cli

WORKDIR /app
COPY . .

# Expose the port Render expects (10000)
EXPOSE 10000

# Run the PHP built-in server, serving webhook.php as default
CMD ["php", "-d", "display_errors=0", "-S", "0.0.0.0:10000", "webhook.php"]
