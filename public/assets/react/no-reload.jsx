import React, { useEffect } from 'react';

function App() {
  useEffect(() => {
    const handleBeforeUnload = (event) => {
      event.preventDefault();
      event.returnValue = ''; // Chrome requires returnValue to be set.
    };

    window.addEventListener('beforeunload', handleBeforeUnload);

    return () => {
      window.removeEventListener('beforeunload', handleBeforeUnload);
    };
  }, []);

  return (
    <div>
      <h1>React App</h1>
      <p>F5 will prompt a confirmation dialog before reloading.</p>
    </div>
  );
}

export default App;