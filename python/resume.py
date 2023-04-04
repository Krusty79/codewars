import openai,re,sys,json
from fpdf import FPDF
import textwrap


pdf = FPDF()
 
# Add a page
pdf.add_page()
pdf.set_font("Arial", size = 15)
f = open("resume.log", "r")

def text_to_pdf(text, filename):
    a4_width_mm = 210
    pt_to_mm = 0.35
    fontsize_pt = 10
    fontsize_mm = fontsize_pt * pt_to_mm
    margin_bottom_mm = 10
    character_width_mm = 7 * pt_to_mm
    width_text = a4_width_mm / character_width_mm

    pdf = FPDF(orientation='P', unit='mm', format='A4')
    pdf.set_auto_page_break(True, margin=margin_bottom_mm)
    pdf.add_page()
    pdf.set_font(family='Courier', size=fontsize_pt)
    splitted = text.split('\n')

    for line in splitted:
        lines = textwrap.wrap(line, width_text)

        if len(lines) == 0:
            pdf.ln()

        for wrap in lines:
            pdf.cell(0, fontsize_mm, wrap, ln=1)

    pdf.output(filename, 'F')


input_filename = 'resume.log'
output_filename = 'resume.pdf'
file = open(input_filename)
text = file.read()
file.close()
text_to_pdf(text, output_filename)

sys.exit()

f = open('config.json')
config = json.load(f)

openai.api_key=config['openai']['api_key']
# Closing file
f.close()

# Set up the model and prompt
model_engine = "text-davinci-003"
#prompt = "Resume for Roman Stoliarov, PHP/Angulat developer, 3 HTML developer in integrio.com. 12 years PHP/Angular in Konductor.net"
prompt = "Resume for Olha Stoliarova, the teacher of the English language and intepriter, experience 15+, studed in Karazin"
log_file = open("resume.log","w")
old_stdout = sys.stdout

sys.stdout = log_file

print(prompt+"\n")


# Generate a response
completion = openai.Completion.create(
    engine=model_engine,
    prompt=prompt,
    max_tokens=2048,
    n=1,
    stop=None,
    temperature=0.5,
)

for resp in completion.choices:
    print('{0}'.format(re.sub(r"[\t]*", "", resp.text)))

sys.stdout=old_stdout

log_file.close()

f = open("resume.log", "r")
 
# insert the texts in pdf
for x in f:
    pdf.cell(200, 10, txt = x, ln = 1, align = 'C')
  
# save the pdf with name .pdf
pdf.output("resume.pdf")  

sys.exit()