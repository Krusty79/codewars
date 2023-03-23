import openai,re,sys,json
  
f = open('config.json')
config = json.load(f)

openai.api_key=config['openai']['api_key']
# Closing file
f.close()

"""
response = openai.ChatCompletion.create(
    model="gpt-3.5-turbo",
    messages=[
            {"role": "system", "content": "You are a chatbot"},
            {"role": "user", "content": "Why should DevOps engineer learn kubernetes?"},
        ]
)

result = ''
for choice in response.choices:
    result += choice.message.content

print(result)
"""

prompt = input("request:")

if len(prompt) < 10 :
    print("request must be a least 10 symbols")
    sys.exit()

# Set up the model and prompt
model_engine = "text-davinci-003"
#prompt = "Гданск во время второй мировой войны..."

# Generate a response
completion = openai.Completion.create(
    engine=model_engine,
    prompt=prompt,
    max_tokens=2048,
    n=6,
    stop=None,
    temperature=0.5,
)

for resp in completion.choices:
    print('<p>{0}</p>'.format(re.sub(r"[\n\t]*", "", resp.text)))

#.replace("\n", " ")