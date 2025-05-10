import styled from 'styled-components';


export const Container = styled.div`
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
`
export const AuthContainer = styled.div`
    width: 30%;
    min-width: 400px;
    height: 400px;
    margin: auto auto;
    padding: 2rem;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
`;

export const Title = styled.h2`
    color: #333;
    text-align: center;
    margin-bottom: 1.5rem;
`;

export const Form = styled.form`
    display: flex;
    flex-direction: column;
    gap: 1rem;
`;

export const Input = styled.input`
    padding: 0.8rem;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 1rem;
`;

export const Button = styled.button`
    padding: 0.8rem;
    background: #1976d2;
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 1rem;
    cursor: pointer;
    transition: background 0.2s;

    &:hover {
        background: #1565c0;
    }
`;

export const ToggleButton = styled.button`
    background: none;
    border: none;
    color: #1976d2;
    cursor: pointer;
    margin-top: 1rem;
    text-align: center;
    width: 100%;
`;

export const ErrorMessage = styled.p`
    color: #d32f2f;
    text-align: center;
`;
