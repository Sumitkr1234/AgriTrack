import sys
import pickle

# Load model
model = pickle.load(open('model.pkl', 'rb'))

# Get inputs
temp = float(sys.argv[1])
humidity = float(sys.argv[2])
rainfall = float(sys.argv[3])

# Predict
prediction = model.predict([[temp, humidity, rainfall]])

print(prediction[0])