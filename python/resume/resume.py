import openai
import json
import re
import sys

f = open('../config.json')
config = json.load(f)
f.close()

openai.api_key = config['openai']['api_key']

file = open('request.txt')
request = file.read().replace('\n', '').replace('\r', '')
file.close()

completion = openai.Completion.create(
    engine="text-davinci-003",
    prompt="Please write resume for employee with these properties: "+request,
    max_tokens=2048,
    n=1,
    stop=None,
    temperature=0.5,
)

for resp in completion.choices:
    # print('{0}'.format(re.sub(r"[\t]*", "", resp.text)))
    print(resp.text)
