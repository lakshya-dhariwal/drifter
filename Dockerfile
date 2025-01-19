# Dockerfile
FROM nginx:latest

# Copy static files to Nginx's default directory
COPY static/ /usr/share/nginx/html/

# Expose port 80 for the Nginx server
EXPOSE 80
