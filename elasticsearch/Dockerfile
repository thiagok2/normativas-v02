FROM elasticsearch:6.7.2

RUN /usr/share/elasticsearch/bin/elasticsearch-plugin install --batch ingest-attachment
#RUN mkdir -p /backup/elastic/data
COPY --chown=elasticsearch:elasticsearch elasticsearch.yml /usr/share/elasticsearch/config/
