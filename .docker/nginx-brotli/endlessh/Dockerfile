# Start with Alpine Linux as intermediate builder image
FROM alpine:latest as intermediate

# Setting version number for `endlessh` download
ARG version=1.0

# Download the source code and extract it
RUN wget -qc https://github.com/skeeto/endlessh/archive/$version.tar.gz -O endlessh.tar.gz \
    && tar -xzf endlessh.tar.gz \
    && cd endlessh* \
    # Add the '-static' option to the 'CFLAGS' line 
    # (Used to compile as a statically-linked executable)
    #
    && sed -i 's/-std=c99/-static\ -std=c99/g' ./Makefile \
    # Install the packages needed to compile C code
    #
    && apk update --no-cache && apk add --no-cache \
        gcc \
        libc-dev \
        libgcc \
        libstdc++ \
        make \
      # Compile the code
      #
      && make \
      # Move the executable to the root directory
      #
      && mv endlessh ../

# Start from scratch
FROM scratch

# Copy the executable from the intermediate builder stage
COPY --from=intermediate /endlessh /

# Expose port 2222 on which the executable listens
EXPOSE 2222/tcp

# System call signal that will be sent to the container to exit
STOPSIGNAL SIGTERM

# Run the endlessh executable
ENTRYPOINT ["/endlessh"]

# Run it in verbose mode
CMD ["-v"]

# Maintainer information
LABEL maintainer="Harsha Vardhan J" \
      github.account="https://github.com/HarshaVardhanJ" \
      dockerfile.github.page="https://github.com/HarshaVardhanJ/docker_files/blob/master/endlessh/Dockerfile" \
      description="This Dockerfile creates an image containing the executable `endlessh` which is an SSH tarpit \
      that very slowly sends an endless, random SSH banner. It keeps SSH clients locked up for hours or even days \
      at a time. The purpose is to put your real SSH server on another port and then let the script kiddies get \
      stuck in this tarpit instead of bothering a real server." \
      sofware.author.github.page="https://github.com/skeeto/endlessh" \
      version="1.0"
