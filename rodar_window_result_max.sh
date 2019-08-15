curl -XPUT "http://localhost:9200/normativas/_settings" -d '{ "index" : { "max_result_window" : 500000 } }' -H "Content-Type: application/json"
