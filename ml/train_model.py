import pandas as pd
from sklearn.tree import DecisionTreeClassifier
import pickle

data = pd.read_csv('crop_data.csv')

X = data[['temperature','humidity','rainfall']]
y = data['crop']

model = DecisionTreeClassifier()
model.fit(X, y)

pickle.dump(model, open('model.pkl', 'wb'))

print("Model trained successfully")